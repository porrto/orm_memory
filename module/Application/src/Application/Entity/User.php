<?php
namespace Application\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Application\Mapper\User")
 */
class User
{

    const SEX_M = 'M';
    const SEX_F = 'F';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $firstName;

    /** @ORM\Column(type="string") */
    protected $lastName;

    /** @ORM\Column(type="integer") */
    protected $age;

    /** @ORM\Column(type="string") */
    protected $sex;

    /** @ORM\Column(type="integer") */
    protected $size;

    /** @ORM\Column(type="datetime", nullable=true) */
    protected $created;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\Ski",
     *     mappedBy="users",
     *     cascade={"persist", "remove"},
     *     fetch="EXTRA_LAZY")
     */
    protected $skis;

    /** @ORM\ManyToOne(targetEntity="Application\Entity\SkiLevel", inversedBy="user")   */
    protected $skiLevel;

    public function __construct() {
        $this->skis = new ArrayCollection();
        $this->created = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param mixed $sex
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getSkiLevel()
    {
        return $this->skiLevel;
    }

    /**
     * @param mixed $skiLevel
     */
    public function setSkiLevel($skiLevel)
    {
        $this->skiLevel = $skiLevel;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getSkis()
    {
        return $this->skis;
    }

    /**
     * @param mixed $skis
     */
    public function setSkis($skis)
    {
        $this->skis = $skis;
    }

}