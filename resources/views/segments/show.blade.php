@push('styles')
    <style>

    </style>
@endpush

<tr class="segment-title">
    <td colspan="3">
        <h4 class="d-inline">{{ $segment->title }}</h4>
        <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#editSegment"><i class="fa fa-edit"></i> Edit</button>
    </td>
</tr>

<tr class="segment-details">
    <td style="width: 10%;">
        <div class="d-flex flex-column text-center align-middle">
            <div class="vote-icon"><i class="fas fa-triangle up-vote"></i></div>
            <div class="vote-icon vote-text">{!! $segment->votes->count() === 0 ? '<i class="fas fa-circle"></i>' : $segment->votes->count() !!}</div>
            <div class="vote-icon"><i class="fas fa-triangle fa-rotate-180 down-vote"></i></div>
        </div>
    </td>
    <td style="width: 30%;">
        <table class="table table-borderless table-condensed">
            <tr>
                <td class="font-weight-bold">Created At:</td>
                <td>{{ $segment->created_at->toDateTimeString() }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Creator:</td>
                <td><a href="{{ $segment->creator->url }}">{{ $segment->creator->name }}</a></td>
            </tr>
            <tr>
                <td class="font-weight-bold">Interval:</td>
                <td>{{ $segment->start_time }} - {{ $segment->finish_time }}</td>
            </tr>
        </table>
    </td>
    <td>
        {{ $segment->details }}
    </td>
</tr>

<tr class="segment-controls">
    <td colspan="3" class="p-1 text-right">
        Comments: {{ $segment->comments->count() }}
        &bull;
        <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#segmentComment">Create Comment</button>
    </td>
</tr>

<tr class="segment-comments">
    <td colspan="3">
        @forelse($segment->comments as $comment)
            <comment :details="{{ $comment }}"></comment>
        @empty
            @include('comments.empty')
        @endforelse
    </td>
</tr>


@push('modals')
    <div class="modal fade" id="segmentComment" tabindex="-1" role="dialog" aria-labelledby="segmentCommentLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="segmentCommentLabel">Create New Segment Comment</h5>
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

    <div class="modal fade" id="editSegment" tabindex="-1" role="dialog" aria-labelledby="editSegmentLabel" aria-hidden="true">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createSegment" tabindex="-1" role="dialog" aria-labelledby="createSegmentLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSegmentLabel">Create New Segment</h5>
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

    </script>
@endpush
