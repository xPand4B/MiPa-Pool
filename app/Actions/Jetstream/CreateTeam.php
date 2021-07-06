<?php

namespace App\Actions\Jetstream;

use App\MiPaPo\MiPaPoLogger;
use App\Models\Team;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Contracts\CreatesTeams;
use Laravel\Jetstream\Events\AddingTeam;
use Laravel\Jetstream\Jetstream;

class CreateTeam implements CreatesTeams
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
    public function create($user, array $input): Team
    {
        Gate::forUser($user)->authorize('create', Jetstream::newTeamModel());

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
        ])->validateWithBag('createTeam');

        AddingTeam::dispatch($user);

        $user->switchTeam($team = $user->ownedTeams()->create([
            'name' => $input['name'],
            'personal_team' => false,
        ]));

        $this->logger->info("Team #$team->id has been created successfully");

        return $team;
    }
}
