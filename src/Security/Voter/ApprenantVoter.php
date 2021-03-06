<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class ApprenantVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['POST_EDIT', 'POST_VIEW'])
            && $subject instanceof \App\Entity\Apprenant;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'EDIT':
                return in_array($user->getRoles()[0],['ROLE_FORMATEUR','ROLE_ADMIN',]);
                break;
            case 'VIEW':
              return in_array($user->getRoles()[0],['ROLE_FORMATEUR','ROLE_APPRENANT']);
                break;
            case 'DELETE':
                return in_array($user->getRoles()[0],['ROLE_FORMATEUR']);
                break;
            case 'PUT':
                return in_array($user->getRoles()[0],['ROLE_FORMATEUR']);
                break;
        }

        return false;
    }
}
