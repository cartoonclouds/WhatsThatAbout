<template>
    <form novalidate @submit.prevent="save">
        <div class="card p-3">
            <div class="row">

                <div class="col-3 px-md-3 px-lg-5">

                    <wta-file name="cover_image" label="Upload cover (270 x 400)" :feedback="errors" :wasValidated="submitted" v-model="model.cover_image"></wta-file>

                </div>

                <div class="col-9">

                    <wta-input name="title" label="Title:" :feedback="errors" :wasValidated="submitted" v-model="model.title"></wta-input>

                    <wta-input name="release_year" input-mask="9999" placeholder="2020" label="Release Year:" :feedback="errors" :wasValidated="submitted" v-model="model.release_year"></wta-input>

                    <wta-input name="runtime" input-mask="99:99:99" label="Runtime:" :feedback="errors" :wasValidated="submitted" v-model="model.runtime"></wta-input>

                    <wta-textarea name="synopsis" label="Synopsis:" rows="6" :feedback="errors" :wasValidated="submitted" v-model="model.synopsis"></wta-textarea>

                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</template>

<script>
export default {
    props: ['model'],
    data() {
        return {
            errors: {},
            submitted: false,
        }
    },
    methods: {
        save()
        {
            this.submitted = false

            axios.post(this.url, new FormData(this.$el))
                .then(response => {

                    //@todo Handle on successful update

                })
                .catch(errors => {
                    this.errors = errors.response.data.errors
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
