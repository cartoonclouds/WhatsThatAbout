<template>
    <div class="modal show fade d-block" id="editSegment" tabindex="-1" role="dialog" aria-labelledby="editSegmentLabel" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSegmentLabel">Edit Segment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="$emit('close')">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
