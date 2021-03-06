<?php

namespace Tickit\ProjectBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Tickit\ProjectBundle\Entity\Project;
use Tickit\ProjectBundle\Interfaces\ProjectAwareInterface;

/**
 * Project deleted event.
 *
 * Dispatched after a project has been deleted from the entity manager
 *
 * @package Tickit\ProjectBundle\Event
 * @author  James Halsall <james.t.halsall@googlemail.com>
 */
class DeleteEvent extends Event implements ProjectAwareInterface
{
    /**
     * The project that is to be deleted
     *
     * @var Project
     */
    protected $project;

    /**
     * Constructor.
     *
     * @param Project $project The project entity to be deleted
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Gets the project on this event
     *
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Sets the project on this event
     *
     * @param Project $project The project to set
     *
     * @return mixed
     */
    public function setProject(Project $project)
    {
        $this->project = $project;
    }
}
