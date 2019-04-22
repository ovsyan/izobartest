<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Employer;
use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository
{
    public function getCommentsAboutUserByUserId(Employer $user)
    {
        return $this->getEntityManager()
            ->getRepository(Comment::class)
            ->findBy(
                [
                    'user_id' => $user->getId()
                ]
            );
    }
}