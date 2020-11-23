<template>
    <div class="modal fade" id="updateOrCreateModal" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="updateOrCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog" v-bind:class="modalSize">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="updateOrCreateModalLabel">
                        <i class="far fa-file-alt"></i> <span v-html="title"></span>
                    </h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body mb-3">
                    <component :model="model" v-bind:is="modelType" v-on:close="modal.hide()"></component>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="saveForm" class="btn btn-primary">Save</button>
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
                return (this.model.model_type || '').split('\\').pop().toLowerCase()
            },
            title()
            {
                return this.model.exists ? `Edit ` + this.modelType.ucwords() + `: <strong>${this.model.title}</strong>` : `Create A New <strong>` + this.modelType.ucwords() + `</strong>`
            },
            modalSize()
            {
                return this.modelType === 'page' ? 'modal-fullscreen' : 'modal-lg';
            }
        },
        mounted()
        {
            // this.modal = new bootstrap.Modal(this.$el, {
            //     backdrop: 'static'
            // })

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
    .modal-dialog.modal-fullscreen {
        margin: 60px;
        width: calc(100vw - 120px);
        height: calc(100vh - 120px);
    }
</style>
