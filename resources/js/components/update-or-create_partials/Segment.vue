<template>
    <form id="saveForm" novalidate @submit.prevent="save">
        <div class="card p-3">
            <div class="row">

                <div class="mb-3">
                    <label>
                        Page: <a :href="model.page.url">{{ model.page.title }}</a>
                    </label>
                    <input type="hidden" name="page_id" :value="model.page_id">
                </div>

                <wta-input name="title" label="Title:" v-bind:feedback="errors" v-bind:wasValidated="submitted" v-model="model.title"></wta-input>

                <wta-input name="start_time" input-mask="99:99:99" label="Start Time:" v-bind:feedback="errors" v-bind:wasValidated="submitted" v-model="model.start_time"></wta-input>

                <wta-input name="finish_time" input-mask="99:99:99" label="Finish Time:" v-bind:feedback="errors" v-bind:wasValidated="submitted" v-model="model.finish_time"></wta-input>

                <wta-checkbox name="runs_throughout" label="Runs Throughout:" v-bind:feedback="errors" v-bind:wasValidated="submitted" v-model="model.runs_throughout"></wta-checkbox>

                <wta-textarea name="details" label="Details:" rows="6" v-bind:feedback="errors" v-bind:wasValidated="submitted" v-model="model.details"></wta-textarea>

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
            pageOptions: {
                'page_1': 'Page 1',
                'page_2': 'Page 2',
                'page_3': 'Page 3',
            },
        }
    },
    methods: {
        save()
        {
            this.submitted = false

            axios.post(this.url, new FormData(this.$el))
                .then(response => {

                    notify(response.data.message, 'Segment Notification', (this.model.exists ? 'info' : 'success'), null, {
                        url: `/segments/${response.data.segment.slug}`
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
            return `/api/segments/updateOrCreate/${this.model.slug || ''}`
        },
    },
    mounted()
    {
        if (!('page' in this.model)) {

        }
    }
}
</script>

<style scoped>

</style>
