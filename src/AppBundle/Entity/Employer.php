<?php
namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmployerRepository")
 * @ORM\Table(name="employer")
 */
class Employer extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * @ORM\Column(type="string",nullable=true)
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

    public function __construct()
    {
        parent::__construct();
    }
}