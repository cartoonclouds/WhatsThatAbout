<scene inline-template :details="{{ $scene }}">
    <table class="table">
        <tbody>
            <tr class="scene-title">
                <td colspan="3">
                    <h4 class="d-inline">
                        @if(!request()->fullUrlIs($scene->url))
                            <a href="{{ $scene->url }}">{{ $scene->title }}</a>
                        @else
                            {{ $scene->title }}
                        @endif
                    </h4>

                    @can('updateOrCreat', user())
                        <button type="button" class="btn btn-dark float-right" @click="$bus.$emit('update-or-create', {{ $scene }})"><i class="fa fa-edit"></i> Edit</button>
                    @endcan
                </td>
            </tr>

            <tr class="scene-details">
                <td style="width: 10%;">
                    <vote :votable="{{ $scene }}"></vote>
                </td>
                <td style="width: 30%;">
                    <table class="table table-borderless table-condensed">
                        <tr>
                            <td class="font-weight-bold">Created At:</td>
                            <td>{{ $scene->created_at->toDateTimeString() }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Creator:</td>
                            <td><a href="{{ $scene->creator->url }}">{{ $scene->creator->name }}</a></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Interval:</td>
                            <td>{{ $scene->start_time }} - {{ $scene->finish_time }}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    {{ $scene->details }}
                </td>
            </tr>

        </tbody>

    </table>
</scene>

<table class="table">
    <tbody>

        <tr class="scene-controls">
            <td colspan="3" class="p-1 text-right">
                Comments: {{ $scene->comments->count() }}
            </td>
        </tr>

        <tr class="scene-comments">
            <td colspan="3">
                @forelse($scene->comments as $comment)
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
        const Scene = {
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
