@extends('layouts.app')
@section('title', 'All Shows')
@push('styles')
    <style>

    </style>
@endpush

@section('content')

<div id="content" class="container-fluid">
    <h3 class="mb-4"><i class="{{ config('website.icons.pages.index') }}"></i> All Pages</h3>
    {!! $dataTable->table() !!}
</div>

@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
    <script>

        $(document).on('click', '[data-bootbox="delete"]', function (event) {
            const $delButton = $(this)
            const pageTitle = $(this).parents('tr').find('.title').text()

            if (!$delButton.data('url')) {
                return
            }

            bootbox.confirm({
                message: `Are you sure you want to delete the page <br><strong class="ml-3">${pageTitle}</strong>?`,
                buttons: {
                    confirm : {
                        label: 'Delete Page',
                        className: 'btn-danger',
                    },
                },
                callback (result) {
                    if (result) {
                        axios.delete($delButton.data('url'))
                            .then(response => {
                                notify(response.data.message, 'Deletion Successful', 'success')
                                //refresh the dt
                            })
                    }
                }
            })
        })

    </script>
@endpush
