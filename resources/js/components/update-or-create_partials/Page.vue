<template>
    <form id="saveForm" novalidate v-on:submit.prevent="save">
        <div class="card p-3">
            <div class="row">

                <div class="col-3 px-md-3 px-lg-5">

                    <wta-file name="cover_image" class="cover-image" label="Upload cover (270 x 400)" v-bind:feedback="errors" v-bind:wasValidated="submitted" v-model="model.cover_image"></wta-file>

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
    }
}
</script>

<style scoped>
    .cover-image {
        height: 400px;
        width: 100%;
        background-color: #2b2b31;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        margin: 0;
        transition: 0.4s ease;
    }

    .cover-image:hover {
        color: #fff;
    }
</style>
