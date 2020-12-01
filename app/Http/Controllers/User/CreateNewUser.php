<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\UserValidationRules;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser extends Controller implements CreatesNewUsers
{
    use UserValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $validated = Validator::make($input, $this->createRules())->validate();

        return $this->persist(new User, $validated);
    }
}
