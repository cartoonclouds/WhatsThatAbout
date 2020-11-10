<template>
    <form novalidate @submit.prevent="save">
        <div class="card p-3">
            <div class="row">

                <wta-input name="title" label="Title:" :feedback="errors" :wasValidated="submitted" v-model="model.title"></wta-input>

                <wta-input name="start_time" input-mask="99:99:99" label="Start Time:" :feedback="errors" :wasValidated="submitted" v-model="model.start_time"></wta-input>

                <wta-input name="finish_time" input-mask="99:99:99" label="Finish Time:" :feedback="errors" :wasValidated="submitted" v-model="model.finish_time"></wta-input>

                <wta-checkbox name="runs_throughout" label="Runs Throughout:" :feedback="errors" :wasValidated="submitted" v-model="model.runs_throughout"></wta-checkbox>

                <wta-textarea name="details" label="Details:" rows="6" :feedback="errors" :wasValidated="submitted" v-model="model.details"></wta-textarea>

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
                        console.log(response)
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
            return `/api/segments/updateOrCreate/${this.model.slug || ''}`
        },
    }
}
</script>

<style scoped>

</style>
