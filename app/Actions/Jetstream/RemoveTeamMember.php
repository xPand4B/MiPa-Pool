<?php

namespace App\Actions\Jetstream;

use App\MiPaPo\MiPaPoLogger;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Contracts\RemovesTeamMembers;
use Laravel\Jetstream\Events\TeamMemberRemoved;

class RemoveTeamMember implements RemovesTeamMembers
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
    public function remove($user, $team, $teamMember): void
    {
        $this->authorize($user, $team, $teamMember);

        $this->ensureUserDoesNotOwnTeam($teamMember, $team);

        $id = $team->id;
        $team->removeUser($teamMember);
        $this->logger->info("User #$user->id has been removed from team #$id successfully!");

        TeamMemberRemoved::dispatch($team, $teamMember);
    }

    /**
     * @throws AuthorizationException
     */
    protected function authorize($user, $team, $teamMember): void
    {
        if (! Gate::forUser($user)->check('removeTeamMember', $team) &&
            $user->id !== $teamMember->id) {
            throw new AuthorizationException;
        }
    }

    /**
     * @throws ValidationException
     */
    protected function ensureUserDoesNotOwnTeam($teamMember, $team): void
    {
        if ($teamMember->id === $team->owner->id) {
            throw ValidationException::withMessages([
                'team' => [__('You may not leave a team that you created.')],
            ])->errorBag('removeTeamMember');
        }
    }
}
