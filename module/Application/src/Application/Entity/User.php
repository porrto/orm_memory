<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Application\Mapper\User")
 */
class User
{
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

    /** @ORM\OneToMany(targetEntity="Application\Entity\Ski", mappedBy="user", cascade={"persist"})   */
    protected $ski;

    /** @ORM\ManyToOne(targetEntity="Application\Entity\SkiLevel", inversedBy="user")   */
    protected $skiLevel;

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
    public function getSki()
    {
        return $this->ski;
    }

    /**
     * @param mixed $ski
     */
    public function setSki($ski)
    {
        $this->ski = $ski;
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
}