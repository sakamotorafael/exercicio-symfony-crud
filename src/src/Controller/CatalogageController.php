<?php

namespace App\Controller;

use App\Entity\Catalogage;
use App\Form\CatalogageType;
use App\Repository\CatalogageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/catalogage')]
class CatalogageController extends AbstractController
{
    #[Route('/', name: 'catalogage_index', methods: ['GET'])]
    public function index(CatalogageRepository $catalogageRepository): Response
    {
        return $this->render('catalogage/index.html.twig', [
            'catalogages' => $catalogageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'catalogage_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $catalogage = new Catalogage();
        $form = $this->createForm(CatalogageType::class, $catalogage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($catalogage);
            $entityManager->flush();

            return $this->redirectToRoute('catalogage_index');
        }

        return $this->render('catalogage/new.html.twig', [
            'catalogage' => $catalogage,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'catalogage_show', methods: ['GET'])]
    public function show(Catalogage $catalogage): Response
    {
        return $this->render('catalogage/show.html.twig', [
            'catalogage' => $catalogage,
        ]);
    }

    #[Route('/{id}/edit', name: 'catalogage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Catalogage $catalogage): Response
    {
        $form = $this->createForm(CatalogageType::class, $catalogage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('catalogage_index');
        }

        return $this->render('catalogage/edit.html.twig', [
            'catalogage' => $catalogage,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'catalogage_delete', methods: ['POST'])]
    public function delete(Request $request, Catalogage $catalogage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$catalogage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($catalogage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('catalogage_index');
    }
}
