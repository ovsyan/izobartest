<?php

namespace AppBundle\Security\Core\User;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\EntityUserProvider;
use HWI\Bundle\OAuthBundle\Security\Core\Exception\AccountNotLinkedException;

class OauthUserProvider extends EntityUserProvider
{
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $userEmail = $response->getEmail();
        $user = $this->findUser(array('email' => $userEmail));

        if (null === $user || null === $userEmail) {
            throw new AccountNotLinkedException(sprintf("User '%s' not found.", $userEmail));
        }

        return $user;
    }

}