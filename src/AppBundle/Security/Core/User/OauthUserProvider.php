<?php

namespace AppBundle\Security\Core\User;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\UserBundle\Model\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use HWI\Bundle\OAuthBundle\Security\Core\Exception\AccountNotLinkedException;

class OauthUserProvider extends FOSUBUserProvider
{
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $userEmail = $response->getEmail();

        $user = $this->userManager->findUserBy(array('email' => $userEmail));
        if (null === $user || null === $userEmail) {
            throw new AccountNotLinkedException(sprintf("User '%s' not found.", $userEmail));
        }

        return $user;
    }

    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Expected an instance of FOS\UserBundle\Model\User, but got "%s".', get_class($user)));
        }
        $property = $this->getProperty($response);
        $userEmail = $response->getEmail();

        if (null !== $previousUser = $this->userManager->findUserBy(array($property => $userEmail))) {
            $this->disconnect($previousUser, $response);
        }

        if ($this->accessor->isWritable($user, $property)) {
            $this->accessor->setValue($user, $property, $userEmail);
        } else {
            throw new \RuntimeException(sprintf('Could not determine access type for property "%s".', $property));
        }

        $this->userManager->updateUser($user);
    }


}