<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\InterpreterRepository;

class InterpreterController extends AbstractController
{
    #[Route('/interpreter', name: 'app_interpreter')]
    public function index(): Response
    {
        return $this->render('interpreter/index.html.twig', [
            'controller_name' => 'InterpreterController',
        ]);
    }

    #[Route('/interpreter/autocomplete', name: 'interpreter_autocomplete')]
    public function autocomplete(Request $request, InterpreterRepository $interpreterRepository): JsonResponse
    {
        $term = $request->get('term');
        $results = $interpreterRepository->findByTerm($term); // Implementiere diese Methode im Repository

        return $this->json($results);
    }
}
