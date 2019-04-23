<?php

namespace AppBundle\Entity;

use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmployerRepository")
 * @ORM\Table(name="employer")
 */
class Employer extends OAuthUser implements \Serializable
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\Email()
     */
    public $email;

    /**
     * @ORM\Column(type="string")
     */
    public $first_name;

    /**
     * @ORM\Column(type="string")
     */
    public $last_name;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    public $surname;

    /**
     * @ORM\Column(type="object",nullable=true)
     * @Assert\File(mimeTypes={"image/jpeg"})
     */
    public $photo;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    public $phone_number;

    /**
     * @ORM\Column(type="string")
     */
    public $position;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    public $vkontakte;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    public $facebook;
    /**
     * @ORM\ManyToOne(targetEntity="Unit")
     * @ORM\JoinColumn(name="unit_id", referencedColumnName="id")
     */
    protected $unit;

    /**
     * @return mixed
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param mixed $unit
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
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

    public function serialize()
    {
        return serialize(array(
            $this->first_name,
            $this->last_name,
            $this->surname,
            $this->phone_number,
            $this->position,
            $this->email
        ));
    }
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);

        list(
            $this->first_name,
            $this->last_name,
            $this->surname,
            $this->phone_number,
            $this->position,
            $this->email) = $data;

    }

}