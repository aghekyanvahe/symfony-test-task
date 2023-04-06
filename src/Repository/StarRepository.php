<?php

namespace App\Repository;

use App\SkyBundle\Entity\Atom;
use App\SkyBundle\Entity\Galaxy;
use App\SkyBundle\Entity\Star;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class StarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Star::class);
    }

    public function create(Star $star, $starData, bool $flush = false): Star
    {
        $starName = $starData['name'];
        $starRadius = $starData['radius'];
        $starGalaxyId = $starData['galaxy_id'];
        $galaxy = $this->getEntityManager()->getRepository(Galaxy::class)->find($starGalaxyId);
        $starAtomId = $starData['atom_id'];
        $atom= $this->getEntityManager()->getRepository(Atom::class)->find($starAtomId);
        $starTemperature = $starData['temperature'];
        $starRotationFrequency = $starData['rotation_frequency'];

        $star->setName($starName);
        $star->setRadius($starRadius);
        $star->setGalaxy($galaxy);
        $star->addAtom($atom);
        $star->setTemperature($starTemperature);
        $star->setRotationFrequency($starRotationFrequency);

        $this->getEntityManager()->persist($star);

        if ($flush) {
            $this->getEntityManager()->flush();
        }

        return $star;
    }

    public function update(Star $star, $starData, bool $flush = false): Star
    {
        $star->setName($starData['name']);
        $starGalaxyId = $starData['galaxy_id'];
        $galaxy = $this->getEntityManager()->getRepository(Galaxy::class)->find($starGalaxyId);
        $star->setGalaxy($galaxy);
        $star->setTemperature($starData['temperature']);
        $star->setRadius($starData['radius']);
        $star->setRotationFrequency($starData['rotation_frequency']);

        if ($flush) {
            $this->getEntityManager()->flush();
        }

        return $star;
    }

    public function remove(Star $star, bool $flush = false): void
    {
        $this->getEntityManager()->remove($star);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
