<?php

namespace App\Controller;

use App\Entity\Film;
use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    /**
     * @Route("/films", name="films")
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
}
