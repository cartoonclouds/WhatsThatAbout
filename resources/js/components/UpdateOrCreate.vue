<template>
    <div class="modal fade" id="updateOrCreateModal" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="updateOrCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateOrCreateModalLabel">New message</h5>
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
                            <textarea class="form-control" id="message-text"></textarea>
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
        props: ['details'],
        data() {
            return {
                showModal: false
            }
        },
        methods: {
            //
        },
        computed: {
            //
        },
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
