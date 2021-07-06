<?php

namespace App\Actions\Jetstream;

use App\MiPaPo\MiPaPoLogger;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Contracts\DeletesTeams;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * @var DeletesTeams
     */
    private $deletesTeams;

    /**
     * @var MiPaPoLogger
     */
    private $logger;

    public function __construct(DeletesTeams $deletesTeams, MiPaPoLogger $logger)
    {
        $this->deletesTeams = $deletesTeams;
        $this->logger = $logger;
    }

    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        DB::transaction(function () use ($user) {
            $id = $user->id;

            $this->deleteTeams($user);
            $user->deleteProfilePhoto();
            $user->tokens->each->delete();
            $user->delete();

            $this->logger->info("User #$id has been deleted successfully!");
        });
    }

    /**
     * Delete the teams and team associations attached to the user.
     *
     * @param  mixed  $user
     * @return void
     */
    protected function deleteTeams($user)
    {
        $user->teams()->detach();

        $user->ownedTeams->each(function ($team) {
            $id = $team->id;
            $this->deletesTeams->delete($team);
            $this->logger->info("Team #$id of user #$this->id has been deleted successfully!");
        });

    }
}
