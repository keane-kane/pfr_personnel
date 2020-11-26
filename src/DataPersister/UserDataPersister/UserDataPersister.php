<?php

namespace App\DataPersister\UserDataPersister;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;

final class UserDataPersister implements DataPersisterInterface
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager,DataPersisterInterface $decorated)
    {
        $this->entityManager = $entityManager;
        $this->decorated = $decorated;
    }

    public function supports($data): bool
    {
        return $data instanceof User;
    }

    public function persist($data)
    {   
        return $data;
    }

    public function remove($data)
    {
        $data->setArchive(true);
        $this->entityManager->flush();
        return $data;
    }

    
}