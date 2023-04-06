<?php

namespace App\ApiBundle;

use App\Repository\AtomRepository;
use App\SkyBundle\Entity\Atom;
use App\SkyBundle\Entity\Star;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AtomController extends AbstractController
{
    private $atomRepository;

    public function __construct(
        AtomRepository $atomRepository
    )
    {
        $this->atomRepository = $atomRepository;
    }

    /**
     * @Route("/atom/create", name="atom_create", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        $atom = new Atom();
        $starId = $request->request->get('star_id');
        $atomName = $request->request->get('name');

        $atom = $this->atomRepository->create($atom, $starId, $atomName, true);

        return $this->json([
            'status' => true,
            'atomName' => $atom->getName()
        ]);
    }
}
