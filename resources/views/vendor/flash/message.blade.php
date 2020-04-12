@foreach (session('flash_notification', collect())->toArray() as $message)
    @push('scripts')
        <script>
            setTimeout(() => {
                $.notify({
                    // options
                    icon: 'glyphicon glyphicon-warning-sign',
                    title: '{{ $message['title'] }}',
                    message: '{{ $message['message'] }}',
                    url: '{{ $message['url'] ?? "" }}',
                    target: '_blank'
                },{
                    // settings
                    type: '{{ $message['level'] }}',
                    allow_dismiss: {{ (bool)$message['important'] }},
                    showProgressbar: false,
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    delay: 5000,
                    animate: {
                        enter: 'animated fadeInDown',
                        exit: 'animated fadeOutUp'
                    },
                });
            }, 1000);
        </script>
    @endpush
@endforeach

{{ session()->forget('flash_notification') }}
