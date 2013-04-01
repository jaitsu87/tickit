<?php

namespace Tickit\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Tickit\UserBundle\Avatar\Entity\AvatarAwareInterface;

/**
 * The User entity represents a logged in user in the application
 *
 * @package Tickit\UserBundle\Entity
 * @author  James Halsall <james.t.halsall@googlemail.com>
 *
 * @ORM\Entity(repositoryClass="Tickit\UserBundle\Entity\Repository\UserRepository")
 * @ORM\Table(name="users")
 */
class User extends BaseUser implements AvatarAwareInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=120)
     */
    protected $forename;

    /**
     * @ORM\Column(type="string", length=120)
     */
    protected $surname;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $created;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    protected $updated;

    /**
     * The group that this user belongs to
     *
     * @ORM\ManyToOne(targetEntity="Group")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     */
    protected $group;

    /**
     * @ORM\OneToMany(targetEntity="UserSession", mappedBy="user")
     */
    protected $sessions;

    /**
     * @ORM\OneToMany(targetEntity="Tickit\PermissionBundle\Entity\UserPermissionValue", mappedBy="user")
     */
    protected $permissions;

    /**
     * @ORM\Column(name="last_activity", type="datetime", nullable=true)
     */
    protected $lastActivity;


    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->sessions = new ArrayCollection();
        $this->permissions = new ArrayCollection();
        parent::__construct();
    }

    /**
     * Gets the ID for this user
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Updates the user's forename
     *
     * @param string $forename The new forename value
     *
     * @return User
     */
    public function setForename($forename)
    {
        $this->forename = $forename;

        return $this;
    }

    /**
     * Gets the user's surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Gets the user's forename
     *
     * @return string
     */
    public function getForename()
    {
        return $this->forename;
    }

    /**
     * Updates the user's surname
     *
     * @param string $surname The new surname value
     *
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Updates the last activity time
     *
     * @param \DateTime $lastActivity
     */
    public function setLastActivity($lastActivity)
    {
        $this->lastActivity = $lastActivity;
    }

    /**
     * Gets the last activity time as a DateTime object
     *
     * @return \DateTime
     */
    public function getLastActivity()
    {
        return $this->lastActivity;
    }

    /**
     * Adds a session object to this user's collection of sessions
     *
     * @param UserSession $session
     */
    public function addSession(UserSession $session)
    {
        $this->sessions[] = $session;
    }

    /**
     * Returns the current session token
     *
     * @return array
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /**
     * Gets the user's concatenated forename and surname
     *
     * @return string
     */
    public function getFullName()
    {
        return sprintf('%s %s', $this->forename, $this->surname);
    }

    /**
     * Gets the time this user was updated as a DateTime object
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return new \DateTime($this->updated);
    }

    /**
     * Gets the created time as a DateTime object
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return new \DateTime($this->created);
    }

    /**
     * Gets the group that this user belongs to
     *
     * @return Group
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Sets the group that this user belongs to
     *
     * @param Group $group The new group
     *
     * @return User
     */
    public function setGroup(Group $group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Gets the name of the user group, if any
     *
     * @return string
     */
    public function getGroupName()
    {
        $group = $this->getGroup();

        if (null !== $group) {
            return $group->getName();
        }

        return '';
    }

    /**
     * Get the avatar identifier
     *
     * @return string
     */
    public function getAvatarIdentifier()
    {
        // return the user's email address string
        return $this->getEmail();
    }
}
