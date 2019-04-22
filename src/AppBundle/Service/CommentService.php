<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Employer;
use AppBundle\Entity\Comment;

class CommentService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getCommentsAboutUser(Employer $user)
    {
        return $this->entityManager->getRepository(Comment::class)
            ->getCommentsAboutUserByUserId($user);
    }

    public function createComment($author, $user, $text)
    {
        $em = $this->entityManager;
        $comment = new Comment();
        $comment->author = $author;
        $comment->user_id = $user;
        $comment->content = $text;
        $comment->date_time = new \DateTime();
        $em->persist($comment);
        $em->flush();
    }
}