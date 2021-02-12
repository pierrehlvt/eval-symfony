<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class SecurityController extends AbstractController
{
    /**
     * @Route("/login_check", name="login_check", methods={"POST"})
     * @return JsonResponse
     */
    public function loginCheck(): JsonResponse
    {
        $user = $this->getUser();

        return new JsonResponse([
            'user' => $user->getUsername(),
            'roles' => $user->getRoles(),
        ]);
    }
}