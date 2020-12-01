<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Rules\UserValidationRules;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation extends Controller implements UpdatesUserProfileInformation
{
    use UserValidationRules;

    /**
     * Validate and update the given user's profile information.
     *
     * @param mixed $user
     * @param array $input
     * @return void
     */
    public function update($user, array $input)
    {
        $this->authorize('update', $user);

        $validated = Validator::make($input, $this->updateRules())->validateWithBag('updateProfileInformation');

        $this->persist($user, $validated);
    }
}
