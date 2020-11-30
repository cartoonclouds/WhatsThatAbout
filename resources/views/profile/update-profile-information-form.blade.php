@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Password</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user-profile-information.update') }}">
                            @csrf
                            @method('PUT')

                            <div>
                                <label>{{ __('Name') }}</label>
                                <input type="text" name="name" value="{{ old('name') ?? auth()->user()->name }}" required autofocus autocomplete="name" />
                            </div>

                            <div>
                                <label>{{ __('Email') }}</label>
                                <input type="email" name="email" value="{{ old('email') ?? auth()->user()->email }}" required autofocus />
                            </div>

                            <div>
                                <button type="submit">
                                    {{ __('Update Profile') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
