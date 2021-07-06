<?php

namespace App\Actions\Fortify;

use App\MiPaPo\MiPaPoLogger;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * @var MiPaPoLogger
     */
    private $logger;

    public function __construct(MiPaPoLogger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @throws ValidationException
     */
    public function update($user, array $input): void
    {
        Validator::make($input, [
            'username'  => ['required', 'string', 'max:255'],
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
            $this->logger->info("Profile photo for user #$user->id has been updated successfully!");
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'username' => $input['username'],
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
        }

        $this->logger->info("User #$user->id has updated there profile information successfully!");
    }

    protected function updateVerifiedUser($user, array $input): void
    {
        $user->forceFill([
            'username' => $input['username'],
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
        $this->logger->info("Email verification has been send to user #$user->id successfully!");
    }
}
