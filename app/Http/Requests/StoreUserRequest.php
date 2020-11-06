<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user ?
            $this->user()->can('update', $this->user) :
            $this->user()->can('create', User::class);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                'string',
                Rule::unique('users', 'title')->ignore($this->user),
            ],
            'synopsis' => 'required|string',
            'release_year' => 'required',
            'thumbnail' => 'required',
            'runtime' => 'required',
            'references' => '',
        ];
    }


    /**
     * Save the User.
     *
     * @param \App\Models\User $user
     * @return \App\Models\User|false
     */
    public function persist(User $user)
    {
        if (!$user->exists) {
            // If the user doesn't exist, we'll assign the
            // user as created by the current user.
            $user->user_id = $this->user()->id;
        }

        $user->fill($this->validated());

        if ($user->save()) {
            // Perform other tasks, maybe fire an event, dispatch a job.
            return $user;
        }

        return false;
    }

}
