
<table class="table table-borderless table-condensed">
    <tr class="segment-comment-controls">
        <td class="small">
            <a href="{{ $comment->commenter->url }}">{{ $comment->commenter->name }}</a>
            &bull;
            {{ $comment->created_at->diffForHumans() }}

            @can('update', $comment)
                <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#editComment"><i class="fa fa-edit"></i> Edit</button>
            @endcan
        </td>
    </tr>
    <tr class="segment-comment-details">
        <td>
            {{ $comment->body }}
        </td>
    </tr>
</table>
<hr>

@push('modals')
    <div class="modal fade" id="editComment" tabindex="-1" role="dialog" aria-labelledby="editCommentLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCommentLabel">Edit Segment Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script type="text/javascript">
        $(document).on('click', '.up-vote, .down-vote', function (event) {
            $(this).toggleClass('selected');
        })
    </script>
@endpush
