<?php

declare(strict_types=1);

namespace EMS\CoreBundle\EventListener;

use EMS\CoreBundle\Core\Revision\Task\TaskManager;
use EMS\CoreBundle\Entity\Revision;

class RevisionDoctrineListener
{
    public function __construct(private readonly TaskManager $taskManager)
    {
    }

    public function preRemoveRevision(Revision $revision): void
    {
        $revision->tasksClear();
    }

    public function postRemoveRevision(Revision $revision): void
    {
        $this->taskManager->tasksDeleteByRevision($revision);
    }
}