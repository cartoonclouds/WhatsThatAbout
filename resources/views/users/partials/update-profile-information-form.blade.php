<form method="POST" class="needs-validation" novalidate action="{{ route('user-profile-information.update') }}">
    @csrf
    @method('PUT')


    <x-form.input name="name" error-bag="updateProfileInformation" value="{{ old('name', $user->name) }}" placeholder="Name"  required autofocus autocomplete="name" help-text="Enter a name for your account" label="Name" :field-errors="$errors->updateProfileInformation"></x-form.input>

    <x-form.input name="username" error-bag="updateProfileInformation" value="{{ old('username', $user->username) }}" placeholder="Username"  required autofocus autocomplete="username" help-text="Enter a username for your account" label="Username" :field-errors="$errors->updateProfileInformation"></x-form.input>

    <x-form.input name="email" error-bag="updateProfileInformation" value="{{ old('email', $user->email) }}" placeholder="Email"  required autofocus autocomplete="email" help-text="Enter an email for your account" label="Email" :field-errors="$errors->updateProfileInformation"></x-form.input>


    <div>
        <button type="submit" class="btn btn-dark">
            {{ __('Update Profile') }}
        </button>
    </div>
</form>
