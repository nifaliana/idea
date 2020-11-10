<?php

namespace App\Controller;

use App\Entity\Panneau;
use App\Form\PanneauType;
use App\Repository\PanneauRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/panneau")
 */
class PanneauController extends AbstractController
{
    /**
     * @Route("/", name="panneau_index", methods={"GET"})
     */
    public function index(PanneauRepository $panneauRepository): Response
    {
        return $this->render('panneau/index.html.twig', [
            'panneaus' => $panneauRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="panneau_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $panneau = new Panneau();
        $form = $this->createForm(PanneauType::class, $panneau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($panneau);
            $entityManager->flush();

            return $this->redirectToRoute('panneau_index');
        }

        return $this->render('panneau/new.html.twig', [
            'panneau' => $panneau,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="panneau_show", methods={"GET"})
     */
    public function show(Panneau $panneau): Response
    {
        return $this->render('panneau/show.html.twig', [
            'panneau' => $panneau,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="panneau_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Panneau $panneau): Response
    {
        $form = $this->createForm(PanneauType::class, $panneau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('panneau_index');
        }

        return $this->render('panneau/edit.html.twig', [
            'panneau' => $panneau,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="panneau_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Panneau $panneau): Response
    {
        if ($this->isCsrfTokenValid('delete'.$panneau->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($panneau);
            $entityManager->flush();
        }

        return $this->redirectToRoute('panneau_index');
    }
}
