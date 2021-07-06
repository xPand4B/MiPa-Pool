<?php

namespace App\Actions\Jetstream;

use App\MiPaPo\MiPaPoLogger;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Contracts\UpdatesTeamNames;

class UpdateTeamName implements UpdatesTeamNames
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
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function update($user, $team, array $input): void
    {
        Gate::forUser($user)->authorize('update', $team);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
        ])->validateWithBag('updateTeamName');

        $team->forceFill([
            'name' => $input['name'],
        ])->save();

        $this->logger->info("Name for team #$team->id has been updated successfully!");
    }
}
