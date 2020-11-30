@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    <div>
                        <p>Thanks for signing up!</p>
                        <p>Before getting started, could you verify your email address by clicking on the link we just emailed to you?</p>
                        <p>If you didn't receive the email, we will gladly send you another.</p>
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="font-weight-bold tw-text-green-600">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @else
                        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Click here to request another</button>.
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
