<?php

namespace App\Controller;

use App\Entity\Typologie;
use App\Form\TypologieType;
use App\Repository\TypologieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/typologie")
 */
class TypologieController extends AbstractController
{
    /**
     * @Route("/", name="typologie_index", methods={"GET"})
     */
    public function index(TypologieRepository $typologieRepository): Response
    {
        return $this->render('typologie/index.html.twig', [
            'typologies' => $typologieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="typologie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typologie = new Typologie();
        $form = $this->createForm(TypologieType::class, $typologie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typologie);
            $entityManager->flush();

            return $this->redirectToRoute('typologie_index');
        }

        return $this->render('typologie/new.html.twig', [
            'typologie' => $typologie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="typologie_show", methods={"GET"})
     */
    public function show(Typologie $typologie): Response
    {
        return $this->render('typologie/show.html.twig', [
            'typologie' => $typologie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="typologie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Typologie $typologie): Response
    {
        $form = $this->createForm(TypologieType::class, $typologie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('typologie_index');
        }

        return $this->render('typologie/edit.html.twig', [
            'typologie' => $typologie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="typologie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Typologie $typologie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typologie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typologie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('typologie_index');
    }
}
