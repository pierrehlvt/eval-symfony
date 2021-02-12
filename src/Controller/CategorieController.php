<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function singleFilm(Categorie $categorie) {

        return $this->render('categorie/singleCategorie.html.twig', [
            'categorie' => $categorie
        ]);
    }
}
