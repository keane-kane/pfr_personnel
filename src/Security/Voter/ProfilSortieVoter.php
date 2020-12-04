<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ProfilSortieVoter extends Voter
{

    protected const ROLE = ['ROLE_ADMIN','ROLE_FORMATEUR'];

    protected function supports($attribute, $subject)
    {   
        if(is_array($subject))dd("array");
        return in_array($attribute, ['EDIT', 'VIEW', 'DELETE','PUT']);
     
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // dd($user);
        // if the user is anonymous, do not grant access
        if (!$user instanceof User) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'EDIT':
                // dd($user->getRoles()[0]);
                return in_array($user->getRoles()[0],self::ROLE);
                break;
            case 'VIEW':
                return in_array($user->getRoles()[0],self::ROLE);
                break;
            case 'PUT':
                return in_array($user->getRoles()[0],self::ROLE);
                break;
            case 'DELETE':
                return in_array($user->getRoles()[0],self::ROLE);
                break;
        }

        return false;
    }
}
