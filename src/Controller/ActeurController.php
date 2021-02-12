<?php

namespace App\Controller;

use App\Entity\Acteur;
use App\Repository\ActeurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/acteurs/{id}", name="single_acteur")
     *
     * @param Acteur $acteur
     * @return Response
     */
    public function singleActeur(Acteur $acteur) {

        return $this->render('acteur/singleActeur.html.twig', [
            'acteur' => $acteur
        ]);
    }

    /**
     * @Route("/api/add/acteur", name="add_acteur", methods={"POST"})
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function addActeur(Request $request, EntityManagerInterface $manager):Response
    {
        $content = json_decode($request->getContent(), true);

        $response = new Response();

        if($content['nom'] && $content['prenom']) {

            $acteur= new Acteur();
            $acteur->setName($content['nom'])
                ->setSurname($content['prenom']);

            $manager->persist($acteur);
            $manager->flush();

            $response->setStatusCode(201, "add acteur ok");
        } else {
            $response->setStatusCode(400, "Erreur add acteur");
        }
        return $response;
    }

    /**
     * @Route("/api/remove/acteur/{id}", name="remove_acteur", methods={"DELETE"})
     *
     * @param ActeurRepository $acteurRepository
     * @param EntityManagerInterface $manager
     * @param int $id
     * @return Response
     */
    public function removeActeur(ActeurRepository $acteurRepository, EntityManagerInterface $manager, $id = 0): Response
    {
        $acteur = $acteurRepository->find($id);
        $response = new Response();

        if($acteur) {
            $manager->remove($acteur);
            $manager->flush();
            $response->setStatusCode(200);
        } else {
            $response->setStatusCode(400);
        }
        return $response;

    }
}
