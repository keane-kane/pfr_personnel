<?php

namespace App\DataPersister\ProfilDataPersister;

use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Profile;

final class ProfilDataPersister implements DataPersisterInterface
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager,DataPersisterInterface $decorated)
    {
        $this->entityManager = $entityManager;
        $this->decorated = $decorated;
    }

    public function supports($data): bool
    {
        return $data instanceof Profile;
    }

    public function persist($data)
    {   
        return $data;
    }

    public function remove($data)
    {
        $data->setArchive(true);
        $users = $data->getUsers();
        foreach($users as $u)
            $u->setArchive(true);

        $this->entityManager->flush();
        return $data;
    }

    
}