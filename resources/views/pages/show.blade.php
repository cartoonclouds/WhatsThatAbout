@extends('layouts.page')
@section('head')
    @parent
    <style>
        .vote-icon {
            font-size: 32px;
            color: #878a8c;
            border-radius: 8px;
        }

        .vote-text {
            font-size: 0.75em !important;
        }

        .vote-icon:not(.vote-text):hover {
            background-color: #e0e2e3;
        }

        .vote-icon .selected {
            color: #000;
        }
    </style>
@stop

@section('content')
    <div id="app">

        <a class="mb-3 btn btn-primary" href="{{ url('pages') }}">Back</a>

        @can('view', user())
        <a class="mb-3 btn btn-primary" href="{{ user()->url }}">{{ user()->name }} <small>({{ user()->email }})</small></a>
        @endcan

        @can('createOrUpdate', $page)
        <a href="{{ url("pages/create") }}" class="btn btn-dark float-right ml-2">Create</a>
        <a href="{{ url("pages/$page->slug/edit") }}" class="btn btn-dark float-right"><i class="fa fa-edit"></i> Edit</a>
        @endcan

        <h1>{{ $page->title }} <small>(Slug: {{ $page->slug }})</small></h1>

        <label>Release Year</label>
        <p>{{ $page->release_year }}</p>

        <label>Creator</label>
        <p>{{ $page->creator->name }}</p>

        <label>Synopsis</label>
        <p>
            {{ $page->synopsis }}
        </p>

        @can('create', \App\Models\Segment::class)
        <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#createSegment">Create Segment</button>
        @endcan

        <hr>

        <h2>Segments:</h2>

        <table class="table">
            <tbody>
            @foreach($page->segments as $segment)
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
                        @foreach($segment->comments as $comment)
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
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>




    </div>
@endsection

@section('modals')
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
@endsection

@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).on('click', '.up-vote, .down-vote', function (event) {
            $(this).toggleClass('selected');
        })
    </script>
@endsection
