@foreach (session('flash_notification', collect())->toArray() as $message)
    @push('scripts')
        <script>
            setTimeout(() => {
                notify(
                    '{{ $message['message'] }}',
                    '{{ $message['title'] }}',
                    '{{ $message['level'] }}',
                    null,
                    {
                        url: '{{ $message['url'] ?? "" }}',
                        target: '_blank'
                    }
                );
            }, 1000);
        </script>
    @endpush
@endforeach

{{ session()->forget('flash_notification') }}
