<!-- Modal -->
<!-- flash-overlay-modal -->
<div class="modal fade {{ $classes ?? '' }}" id="{{ $name }}" tabindex="-1" role="dialog" aria-labelledby="{{ $name }}Label" aria-hidden="true">
    <div class="modal-dialog {{ $sizeSmall ?? 'modal-lg'  }}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $name }}Label">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! $body !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
