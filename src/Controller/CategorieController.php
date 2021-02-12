<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categories", name="categories")
     * 
     * @param CategorieRepository $categorieRepository
     * @return Response
     */
    public function index(CategorieRepository $categorieRepository): Response
    {
        
        $categories = $categorieRepository->findAll();
        
        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/categories/{id}", name="single_categorie")
     *
     * @param Categorie $categorie
     * @return Response
     */
    public function singleCategorie(Categorie $categorie) {

        return $this->render('categorie/singleCategorie.html.twig', [
            'categorie' => $categorie
        ]);
    }

    /**
     * @Route("/api/add/categorie", name="add_categorie", methods={"POST"})
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function addCategorie(Request $request, EntityManagerInterface $manager):Response
    {
        $content = json_decode($request->getContent(), true);

        $response = new Response();

        if($content['nom']) {

            $categorie = new Categorie();
            $categorie->setName($content['nom']);

            $manager->persist($categorie);
            $manager->flush();

            $response->setStatusCode(201, "add categorie ok");
        } else {
            $response->setStatusCode(400, "Erreur add categorie");
        }
        return $response;
    }

    /**
     * @Route("/api/remove/categorie/{id}", name="remove_categorie", methods={"DELETE"})
     *
     * @param CategorieRepository $categorieRepository
     * @param EntityManagerInterface $manager
     * @param int $id
     * @return Response
     */
    public function removeCategorie(CategorieRepository $categorieRepository, EntityManagerInterface $manager, $id = 0): Response
    {
        $categorie = $categorieRepository->find($id);
        $response = new Response();

        if($categorie) {
            $manager->remove($categorie);
            $manager->flush();
            $response->setStatusCode(200);
        } else {
            $response->setStatusCode(400);
        }
        return $response;

    }
}
