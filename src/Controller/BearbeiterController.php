<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\BearbeiterRepository;

class BearbeiterController extends AbstractController
{
    #[Route('/bearbeiter', name: 'app_bearbeiter')]
    public function index(): Response
    {
        return $this->render('bearbeiter/index.html.twig', [
            'controller_name' => 'BearbeiterController',
        ]);
    }

    #[Route('/bearbeiter/autocomplete', name: 'bearbeiter_autocomplete')]
    public function autocomplete(Request $request, BearbeiterRepository $bearbeiterRepository): JsonResponse
    {
        $term = $request->get('term');
        $results = $bearbeiterRepository->findByTerm($term); // Implementiere diese Methode im Repository

        return $this->json($results);
    }
}
