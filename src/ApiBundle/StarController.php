<?php

namespace App\ApiBundle;

use App\Repository\StarRepository;
use App\SkyBundle\Entity\Atom;
use App\SkyBundle\Entity\Galaxy;
use App\SkyBundle\Entity\Star;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StarController extends AbstractController
{
    private $starRepository;

    public function __construct(
        StarRepository $starRepository
    ) {
        $this->starRepository = $starRepository;
    }

    /**
     * @Route("star/create", name="star_new", methods={"GET","POST"})
     */
    public function create(Request $request): Response
    {
        $star = new Star();
        $starData = $request->request->all();

        $star = $this->starRepository->create($star, $starData, true);
        $radius = $star->getRadius();
        $value = 4/3 * 3.14 * pow($radius, 3);

        return $this->json([
            'status' => true,
            'starName' => $star->getName(),
            'radius' => $radius,
            'temperature' => $star->getTemperature(),
            'value' => $value
        ]);
    }

    /**
     * @Route("/star/{id}/update", name="star_update", methods={"POST"})
     */
    public function update(Request $request, Star $star): Response
    {
        $starData = $request->request->all();
        $star = $this->starRepository->update($star, $starData, true);

        return $this->json([
            'status' => true,
            'starName' => $star->getName()
        ]);
    }

    /**
     * @Route("star/{id}/delete", name="star_delete", methods={"POST"})
     */
    public function delete(Star $star): Response
    {
        $this->starRepository->remove($star, true);

        return $this->json([
            'status' => true,
            'message' => 'star is deleted'
        ]);
    }
}
