<template>
    <form id="saveForm" novalidate v-on:submit.prevent="save">
        <div class="card p-3">
            <div class="row">

                <div class="col-3 px-md-3 px-lg-5">

                    <wta-image-file name="cover_image" class="cover_image" label="Upload cover (270 x 400)" description="Cover Image" v-bind:feedback="errors" v-bind:wasValidated="submitted" v-model="model.cover_image.file_path"></wta-image-file>

                    <wta-image-file name="hero_image" class="hero_image" label="Upload hero (350 x 150)" description="Hero (Background) Image" v-bind:feedback="errors" v-bind:wasValidated="submitted" v-model="model.hero_image.file_path"></wta-image-file>

                </div>

                <div class="col-9">

                    <wta-input name="title" label="Title:" v-bind:feedback="errors" v-bind:wasValidated="submitted" v-model="model.title"></wta-input>

                    <wta-input name="release_year" input-mask="9999" placeholder="2020" label="Release Year:" v-bind:feedback="errors" v-bind:wasValidated="submitted" v-model="model.release_year"></wta-input>

                    <wta-input name="runtime" input-mask="99:99:99" label="Runtime:" v-bind:feedback="errors" v-bind:wasValidated="submitted" v-model="model.runtime"></wta-input>

                    <wta-textarea name="synopsis" label="Synopsis:" rows="6" v-bind:feedback="errors" v-bind:wasValidated="submitted" v-model="model.synopsis"></wta-textarea>

                </div>

            </div>
        </div>

    </form>
</template>

<script>
export default {
    props: ['model'],
    data() {
        return {
            errors: {},
            errorMessage: null,
            submitted: false,
        }
    },
    methods: {
        save()
        {
            this.submitted = false

            axios.post(this.url, new FormData(this.$el))
                .then(response => {

                    notify(response.data.message, 'Page Notification', (this.model.exists ? 'info' : 'success'), null, {
                        url: `/${response.data.page.slug}`
                    })

                    this.$emit('close')

                    if (this.model.exists) { // implies an update so reload
                        window.reload();
                    }

                })
                .catch(errors => {
                    this.errors = errors.response.data.errors
                    this.errorMessage = errors.response.message
                })
                .finally(() => {
                    this.submitted = true
                })
        }
    },
    computed: {
        url()
        {
            return `/api/pages/updateOrCreate/${this.model.slug || ''}`
        },
    },
    mounted()
    {
        if (!('cover_image' in this.model)) {
            this.$set(this.model, 'cover_image', {file_path: ''});
        }

        if (!('hero_image' in this.model)) {
            this.$set(this.model, 'hero_image', {file_path: ''});
        }
    }
}
</script>

<style scoped>
    .cover_image, .hero_image {
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        margin: 0;
        transition: 0.4s ease;
    }

    .cover_image {
        height: 400px;
    }

    .hero_image {
        height: 150px;
    }

    .cover_image:hover, .hero_image:hover {
        color: #fff;
    }
</style>
