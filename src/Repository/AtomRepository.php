<?php

namespace App\Repository;

use App\SkyBundle\Entity\Atom;
use App\SkyBundle\Entity\Galaxy;
use App\SkyBundle\Entity\Star;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityRepository;

class AtomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Atom::class);
    }

    public function create(Atom $atom, $starId, $atomName, bool $flush = false): Atom
    {
        $atomStar = $this->getEntityManager()->getRepository(Star::class)->find($starId);
        $atom->setName($atomName);
        $atom->addStar($atomStar);

        $this->getEntityManager()->persist($atom);

        if ($flush) {
            $this->getEntityManager()->flush();
        }

        return $atom;
    }

    public function remove(Atom $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
