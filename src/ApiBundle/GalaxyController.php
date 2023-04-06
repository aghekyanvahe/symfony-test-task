<?php

namespace App\ApiBundle;

use App\Repository\GalaxyRepository;
use App\SkyBundle\Entity\Galaxy;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GalaxyController extends AbstractController
{
    private $galaxyRepository;

    public function __construct(
        GalaxyRepository $galaxyRepository
    ) {
        $this->galaxyRepository = $galaxyRepository;
    }

    /**
     * @Route("/galaxy/create", name="galaxy_new", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        $galaxyEntity = new Galaxy();
        $galaxyName = $request->request->get('name');

        $galaxy = $this->galaxyRepository->create($galaxyEntity, $galaxyName, true);

        return $this->json($galaxy);
    }

    /**
     * @Route("/galaxy/{id}/update", name="galaxy_update", methods={"GET","POST"})
     */
    public function update(Request $request, Galaxy $galaxy): Response
    {
        $galaxyName = $request->request->get('name');
        $galaxy = $this->galaxyRepository->update($galaxy, $galaxyName, true);

        return $this->json($galaxy);
    }

    /**
     * @Route("/galaxy/{id}/delete", name="galaxy_delete", methods={"POST"})
     */
    public function delete(Galaxy $galaxy): Response
    {
        $this->galaxyRepository->remove($galaxy,true);

        return $this->json([
            'status' => true,
            'message' => 'galaxy is deleted'
        ]);
    }

    /**
     * @Route("/galaxy/{id}/stars", name="galaxy_stars", methods={"POST"})
     */
    public function uniqueStars(Request $request,Galaxy $galaxy)
    {
        $galaxy_id = $galaxy->getId();
        $stars = $galaxy->getStars()->toArray();
        $galaxyAtoms = [];
        foreach ($stars as $star){
            $atoms = $star->getAtoms()->getValues();
           foreach ($atoms as $atom){
                   $galaxyAtoms[] = $atom;
           }
        }
        $otherGalaxyAtoms = $this->allAtoms($galaxy_id);
        $uniqueAtoms = [];
        foreach ($otherGalaxyAtoms as $otherGalaxyAtom){
            foreach ($galaxyAtoms as $atom){
                if ((int)$otherGalaxyAtom->getId() === (int)$atom->getId()){
                    $uniqueAtoms[] = $atom;
                }
            }
        }

        $getStars = [];
        foreach ($uniqueAtoms as $uniq){
            $getStars[] = ($uniq->getStar()->getValues());
        }
    }

    public function allAtoms($galaxy_id)
    {
        $repository = $this->entityManager->getRepository(Galaxy::class);
        $allGalaxies = $repository->findAll();

        $otherGalaxyAtoms = [];
        foreach($allGalaxies as $galaxy){
            if ((int)$galaxy->getId() !== (int)$galaxy_id){
                $stars = $galaxy->getStars()->toArray();
                foreach ($stars as $star){
                    $atoms = $star->getAtoms()->getValues();
                    foreach ($atoms as $atom){
                        $otherGalaxyAtoms[] = $atom;
                    }
                }
            }
        }

       return $otherGalaxyAtoms;
    }
}
