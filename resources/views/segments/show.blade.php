<segment inline-template :details="{{ $segment }}">
    <table class="table">
        <tbody>
            <tr class="segment-title">
                <td colspan="3">
                    <h4 class="d-inline">{{ $segment->title }}</h4>
                    <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#updateOrCreateModal"><i class="fa fa-edit"></i> Edit</button>
                </td>
            </tr>

            <tr class="segment-details">
                <td style="width: 10%;">
                    <vote :votable="{{ $segment }}"></vote>
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
        </tbody>
    </table>
</segment>
