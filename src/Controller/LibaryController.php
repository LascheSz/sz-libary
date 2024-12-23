<?php

namespace App\Controller;

use App\Entity\Bearbeiter;
use App\Entity\Interpreter;
use App\Entity\Stuecke;
use App\Form\StueckeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class LibaryController extends AbstractController
{
    #[Route('/libary', name: 'app_libary')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $stuecke = new Stuecke();
        $form = $this->createForm(StueckeType::class, $stuecke);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Interpreter verarbeiten
            $interpreterName = $form->get('interpreter_name')->getData();
            if ($interpreterName) {
                $interpreter = $entityManager->getRepository(Interpreter::class)
                    ->findOneBy(['name' => $interpreterName]);
                
                if (!$interpreter) {
                    // Neuen Interpreter erstellen
                    $interpreter = new Interpreter();
                    $interpreter->setName($interpreterName);
                    $entityManager->persist($interpreter);
                }
                // Interpreter mit Stück verknüpfen
                $stuecke->setInterpreter($interpreter);
            }

            // Bearbeiter verarbeiten
            $bearbeiterName = $form->get('bearbeiter_name')->getData();
            if ($bearbeiterName) {
                $bearbeiter = $entityManager->getRepository(Bearbeiter::class)
                    ->findOneBy(['name' => $bearbeiterName]);
                
                if (!$bearbeiter) {
                    // Neuen Bearbeiter erstellen
                    $bearbeiter = new Bearbeiter();
                    $bearbeiter->setName($bearbeiterName);
                    $entityManager->persist($bearbeiter);
                }
                // Bearbeiter mit Stück verknüpfen
                $stuecke->setBearbeiter($bearbeiter);
            }

            // Stück speichern
            $entityManager->persist($stuecke);
            $entityManager->flush();

            return $this->redirectToRoute('app_libary');
        }

        // Hole alle Stücke für die Anzeige
        $alleStuecke = $entityManager->getRepository(Stuecke::class)->findAll();

        return $this->render('libary/index.html.twig', [
            'StueckeTypeForm' => $form->createView(),
            'stuecke' => $alleStuecke,
            'controller_name' => 'LibaryController'
        ]);
    }

    #[Route('/interpreter/autocomplete', name: 'interpreter_autocomplete')]
    public function interpreterAutocomplete(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $term = $request->query->get('term');
        
        // Debug-Log
        error_log('Searching for interpreter: ' . $term);
        
        if (empty($term)) {
            return new JsonResponse([]);
        }

        $interpreters = $entityManager->getRepository(Interpreter::class)
            ->createQueryBuilder('i')
            ->where('LOWER(i.name) LIKE LOWER(:term)')  // Case-insensitive Suche
            ->setParameter('term', '%' . $term . '%')
            ->getQuery()
            ->getResult();

        $suggestions = [];
        foreach ($interpreters as $interpreter) {
            $suggestions[] = [
                'label' => $interpreter->getName() . ' (bereits vorhanden)',
                'value' => $interpreter->getName()
            ];
        }

        // Wenn keine Vorschläge gefunden wurden
        // if (empty($suggestions)) {
        //     $suggestions[] = [
        //         'label' => 'Neuer Eintrag: "' . $term . '"',
        //         'value' => $term
        //     ];
        // }

        // Debug-Log
        error_log('Returning suggestions: ' . json_encode($suggestions));

        return new JsonResponse($suggestions);
    }
    #[Route('/bearbeiter/autocomplete', name: 'bearbeiter_autocomplete')]
    public function bearbeiterAutocomplete(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $term = $request->query->get('term');
        
        // Debug-Log
        error_log('Searching for bearbeiter: ' . $term);
        
        if (empty($term)) {
            return new JsonResponse([]);
        }

        $bearbeiters = $entityManager->getRepository(Bearbeiter::class)
            ->createQueryBuilder('b')
            ->where('LOWER(b.name) LIKE LOWER(:term)')  // Case-insensitive Suche
            ->setParameter('term', '%' . $term . '%')
            ->getQuery()
            ->getResult();

        $suggestions = [];
        foreach ($bearbeiters as $bearbeiter) {
            $suggestions[] = [
                'label' => $bearbeiter->getName(),
                'value' => $bearbeiter->getName()
            ];
        }

        // Wenn keine Vorschläge gefunden wurden
        if (empty($suggestions)) {
            $suggestions[] = [
                'label' => 'Neuer Eintrag: "' . $term . '"',
                'value' => $term
            ];
        }

        // Debug-Log
        error_log('Returning suggestions: ' . json_encode($suggestions));

        return new JsonResponse($suggestions);
    }
}