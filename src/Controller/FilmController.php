<?php

namespace App\Controller;

use App\Entity\Film;
use App\Repository\ActeurRepository;
use App\Repository\CategorieRepository;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    
    /**
     * @Route("/", name="films")
     * @param FilmRepository $filmRepository
     * @return Response
     */
    public function index(FilmRepository $filmRepository): Response
    {
        $films = $filmRepository->findAll();
        
        return $this->render('film/index.html.twig', [
            'films' => $films,
        ]);
    }

    /**
     * @Route("/films/{id}", name="single_film")
     *
     * @param Film $film
     * @return Response
     */
    public function singleFilm(Film $film) {
        
        return $this->render('film/singleFilm.html.twig', [
           'film' => $film 
        ]);
    }

    /**
     * @Route("/api/add/film", name="add_film", methods={"POST"})
     *
     * @param Request $request
     * @param ActeurRepository $acteurRepository
     * @param CategorieRepository $categorieRepository
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function addFilm(Request $request, ActeurRepository $acteurRepository, CategorieRepository $categorieRepository, EntityManagerInterface $manager):Response
    {
        $content = json_decode($request->getContent(), true);

        $response = new Response();

        if($content['acteurId'] && $content['nom'] && $content['categorieId']) {
            $categorie = $categorieRepository->find($content['categorieId']);
            $acteur = $acteurRepository->find($content['acteurId']);

            $film = new Film();
            $film->setName($content['nom'])
                ->setCategorie($categorie)
                ->addActeur($acteur);

            $manager->persist($film);
            $manager->flush();

            $response->setStatusCode(201, "add film ok");
        } else {
            $response->setStatusCode(400, "Erreur add film");
        }
        return $response;
    }

    /**
     * @Route("/api/remove/film/{id}", name="remove_film", methods={"DELETE"})
     * 
     * @param FilmRepository $filmRepository
     * @param EntityManagerInterface $manager
     * @param int $id
     * @return Response
     */
    public function removeFilm(FilmRepository $filmRepository, EntityManagerInterface $manager, $id = 0): Response
    {
        $film = $filmRepository->find($id);
        $response = new Response();

        if($film) {
            $manager->remove($film);
            $manager->flush();
            $response->setStatusCode(200);
        } else {
            $response->setStatusCode(400);
        }
        return $response;
        
    }
}
