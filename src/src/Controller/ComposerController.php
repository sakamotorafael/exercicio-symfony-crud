<?php

namespace App\Controller;

use App\Entity\Composer;
use App\Form\ComposerType;
use App\Repository\ComposerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/composer')]
class ComposerController extends AbstractController
{
    #[Route('/', name: 'composer_index', methods: ['GET'])]
    public function index(ComposerRepository $composerRepository): Response
    {
        return $this->render('composer/index.html.twig', [
            'composers' => $composerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'composer_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $composer = new Composer();
        $form = $this->createForm(ComposerType::class, $composer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($composer);
            $entityManager->flush();

            return $this->redirectToRoute('composer_index');
        }

        return $this->render('composer/new.html.twig', [
            'composer' => $composer,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'composer_show', methods: ['GET'])]
    public function show(Composer $composer): Response
    {
        return $this->render('composer/show.html.twig', [
            'composer' => $composer,
        ]);
    }

    #[Route('/{id}/edit', name: 'composer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Composer $composer): Response
    {
        $form = $this->createForm(ComposerType::class, $composer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('composer_index');
        }

        return $this->render('composer/edit.html.twig', [
            'composer' => $composer,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'composer_delete', methods: ['POST'])]
    public function delete(Request $request, Composer $composer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$composer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($composer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('composer_index');
    }
}
