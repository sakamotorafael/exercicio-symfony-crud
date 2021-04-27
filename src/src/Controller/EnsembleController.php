<?php

namespace App\Controller;

use App\Entity\Ensemble;
use App\Form\EnsembleType;
use App\Repository\EnsembleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ensemble')]
class EnsembleController extends AbstractController
{
    #[Route('/', name: 'ensemble_index', methods: ['GET'])]
    public function index(EnsembleRepository $ensembleRepository): Response
    {
        return $this->render('ensemble/index.html.twig', [
            'ensembles' => $ensembleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'ensemble_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $ensemble = new Ensemble();
        $form = $this->createForm(EnsembleType::class, $ensemble);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ensemble);
            $entityManager->flush();

            return $this->redirectToRoute('ensemble_index');
        }

        return $this->render('ensemble/new.html.twig', [
            'ensemble' => $ensemble,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'ensemble_show', methods: ['GET'])]
    public function show(Ensemble $ensemble): Response
    {
        return $this->render('ensemble/show.html.twig', [
            'ensemble' => $ensemble,
        ]);
    }

    #[Route('/{id}/edit', name: 'ensemble_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ensemble $ensemble): Response
    {
        $form = $this->createForm(EnsembleType::class, $ensemble);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ensemble_index');
        }

        return $this->render('ensemble/edit.html.twig', [
            'ensemble' => $ensemble,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'ensemble_delete', methods: ['POST'])]
    public function delete(Request $request, Ensemble $ensemble): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ensemble->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ensemble);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ensemble_index');
    }
}
