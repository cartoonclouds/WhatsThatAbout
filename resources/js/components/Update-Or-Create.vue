<template>
    <div class="modal fade" id="updateOrCreateModal" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="updateOrCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="updateOrCreateModalLabel">Change Type: {{ modelType }} - <strong>{{ model.model_type }}</strong> - New message</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <component :model="model" :is="modelType"></component>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import Page from './update-or-create_partials/Page'
    import Segment from './update-or-create_partials/Segment'

    export default {
        data() {
            return {
                model: {},
                modal: undefined
            }
        },
        components: {
            'page': Page,
            'segment': Segment,
        },
        computed: {
            modelType()
            {
                return (this.model.model_type || '').split('\\').reverse()[0].toLowerCase()
            }
        },
        mounted()
        {
            this.modal = new bootstrap.Modal(this.$el, {
                backdrop: 'static'
            })

            EventBus.$on('update-or-create', (model) => {
                this.model = model || {}

                this.modal.show()
            })

            this.$el.addEventListener('hidden.bs.modal', (event) => {
                this.model = {}
            })
        }
    }
</script>

<style scoped>
    .modal-dialog {
        margin: 58px;
    }

    .modal-fullscreen {
        width: calc(100vw - 120px);
        height: calc(100% - 120px);
    }
</style>
