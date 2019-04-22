<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentRepository")
 * @ORM\Table(name="comment")
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Employer")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    public $author;

    /**
     * @ORM\ManyToOne(targetEntity="Employer")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $user_id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    public $content;

    /**
     * @ORM\Column(type="datetime")
     */
    public $date_time;
}