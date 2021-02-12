<?php

namespace App\Controller;

use App\Repository\ActeurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActeurController extends AbstractController
{
    /**
     * @Route("/acteurs", name="acteurs")
     * 
     * @param ActeurRepository $acteurRepository
     * @return Response
     */
    public function index(ActeurRepository $acteurRepository): Response
    {
        $acteurs = $acteurRepository->findAll();
        return $this->render('acteur/index.html.twig', [
            'acteurs' => $acteurs,
        ]);
    }
}
