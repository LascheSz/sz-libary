<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MusikheimController extends AbstractController
{
    #[Route('/musikheim', name: 'app_musikheim')]
    public function index(): Response
    {
        return $this->render('musikheim/index.html.twig', [
            'controller_name' => 'MusikheimController',
        ]);
    }
}
