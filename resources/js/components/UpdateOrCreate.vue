<template>
    <div class="modal fade" id="updateOrCreateModal" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="updateOrCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="updateOrCreateModalLabel">Change Type: {{ changeType }} - New message</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text">
                                {{ model.details }}
                            </textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                changeType: undefined,
                model: {},
                modal: undefined
            }
        },
        methods: {
            //
        },
        mounted()
        {
            this.modal = new bootstrap.Modal(this.$el)

            EventBus.$on('update-or-create', (changeType, model) => {
                this.changeType = changeType
                this.model = model || {}

                this.modal.show()
            })

            this.$el.addEventListener('hidden.bs.modal', (event) => {
                this.changeType = undefined
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
