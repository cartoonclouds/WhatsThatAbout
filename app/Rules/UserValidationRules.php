<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;

trait UserValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules(): array
    {
        return ['required', 'string', new Password, 'confirmed'];
    }

    /**
     * A list of general rules used during creating and updating a user.
     *
     * @return array
     */
    private function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'string',
                'max:255',
            ],
        ];
    }

    /**
     * Get the validation rules used to validate a created user.
     *
     * @return array
     */
    protected function createRules(): array
    {
        return $this->rules() + [
            'password' => $this->passwordRules(),
            'username' => Rule::unique(User::class),
            'email' => Rule::unique(User::class),
        ];
    }

    /**
     * Get the validation rules used to validate a updated user.
     *
     * @return array
     */
    protected function updateRules(): array
    {
        return $this->rules() + [
                'banned' => 'in:1',
                'banned_reason' => 'string',
                'banned_by' => 'exists:users,id',
                'banned_at' => 'datetime',
                'username' => Rule::unique('users')->ignore(user()->id),
                'email' => Rule::unique('users')->ignore(user()->id),
            ];
    }


    /**
     * Save the User.
     *
     * @param \App\Models\User $user
     * @return \App\Models\User|false
     */
    public function persist(User $user, $input)
    {
        if (!$user->exists) {

            // create a new user and hash the password
            $user->password = Hash::make($input['password']);


        } else {

            // if the user hasn't been verified but email changed, resend the verify email notification
            if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {

                $this->updateVerifiedUser($user, $input);

            }

        }


        $user->fill($input);


        if ($user->save()) {
            // Perform other tasks, maybe fire an event, dispatch a job.
            return $user;
        }

        return false;
    }


    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
