<?php

namespace App\Repository;

use App\SkyBundle\Entity\Galaxy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GalaxyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Galaxy::class);
    }

    public function create(Galaxy $galaxy, $galaxyName, bool $flush = false): Galaxy
    {
        $galaxy->setName($galaxyName);
        $this->getEntityManager()->persist($galaxy);

        if ($flush) {
            $this->getEntityManager()->flush();
        }

        return $galaxy;
    }

    public function update(Galaxy $galaxy, $galaxyName, bool $flush = false): Galaxy
    {
        $galaxy->setName($galaxyName);

        if ($flush) {
            $this->getEntityManager()->flush();
        }

        return $galaxy;
    }

    public function remove(Galaxy $galaxy, bool $flush = false): void
    {
        $this->getEntityManager()->remove($galaxy);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
