<?php

namespace App\Security\Voter;

use App\Entity\Formateur;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class FormateurVoter extends Voter
{
    protected const ROLE = ['ROLE_ADMIN','ROLE_FORMATEUR'];
    protected function supports($attribute, $subject)
    {
        return in_array($attribute, ['EDIT', 'VIEW','DELETE','PUT'])
            && $subject instanceof \App\Entity\Formateur;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        dd($attribute);
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'EDIT':
                return in_array($user->getRoles()[0],self::ROLE);
                break;
            case 'VIEW':
              return in_array($user->getRoles()[0],self::ROLE);
                break;
            case 'DELETE':
                return in_array($user->getRoles()[0],self::ROLE);
                break;
            case 'PUT':
                return in_array($user->getRoles()[0],self::ROLE);
                break;
        }

        return false;
    }
}
