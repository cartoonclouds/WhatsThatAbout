<segment inline-template :details="{{ $segment }}">
    <table class="table">
        <tbody>
            <tr class="segment-title">
                <td colspan="3">
                    <h4 class="d-inline">
                        @if(!request()->fullUrlIs($segment->url))
                            <a href="{{ $segment->url }}">{{ $segment->title }}</a>
                        @else
                            {{ $segment->title }}
                        @endif
                    </h4>

                    @can('updateOrCreat', user())
                        <button type="button" class="btn btn-dark float-right" @click="$bus.$emit('update-or-create', 'edit', {{ $segment }})"><i class="fa fa-edit"></i> Edit</button>
                    @endcan
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

        </tbody>

    </table>
</segment>

<table class="table">
    <tbody>

        <tr class="segment-controls">
            <td colspan="3" class="p-1 text-right">
                Comments: {{ $segment->comments->count() }}
            </td>
        </tr>

        <tr class="segment-comments">
            <td colspan="3">
                @forelse($segment->comments as $comment)
                    <comment :details="{{ $comment }}"></comment>
                @empty
                    @include('comments.partials.empty')
                @endforelse

                <comment :details="{}"></comment>
            </td>
        </tr>

    </tbody>
</table>

@push('scripts')
    @once
        <script>
        const Segment = {
            props: ['details'],
            data() {
                return {
                    //
                }
            },
            methods: {
                edit()
                {

                }
            },
            computed: {
                //
            },
        }
        </script>
    @endonce
@endpush
