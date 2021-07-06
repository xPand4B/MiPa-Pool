<?php

namespace App\Actions\Jetstream;

use App\MiPaPo\MiPaPoLogger;
use Laravel\Jetstream\Contracts\DeletesTeams;

class DeleteTeam implements DeletesTeams
{
    /**
     * @var MiPaPoLogger
     */
    private $logger;

    public function __construct(MiPaPoLogger $logger)
    {
        $this->logger = $logger;
    }

    public function delete($team): void
    {
        $team->purge();
        $this->logger->info("Team #$team->id has been deleted successfully");
    }
}
