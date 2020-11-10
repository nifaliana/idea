<?php

namespace App\Controller;

use App\Entity\PanneauOffre;
use App\Form\PanneauOffreType;
use App\Repository\PanneauOffreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/panneau/offre")
 */
class PanneauOffreController extends AbstractController
{
    /**
     * @Route("/", name="panneau_offre_index", methods={"GET"})
     */
    public function index(PanneauOffreRepository $panneauOffreRepository): Response
    {
        return $this->render('panneau_offre/index.html.twig', [
            'panneau_offres' => $panneauOffreRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="panneau_offre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $panneauOffre = new PanneauOffre();
        $form = $this->createForm(PanneauOffreType::class, $panneauOffre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($panneauOffre);
            $entityManager->flush();

            return $this->redirectToRoute('panneau_offre_index');
        }

        return $this->render('panneau_offre/new.html.twig', [
            'panneau_offre' => $panneauOffre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="panneau_offre_show", methods={"GET"})
     */
    public function show(PanneauOffre $panneauOffre): Response
    {
        return $this->render('panneau_offre/show.html.twig', [
            'panneau_offre' => $panneauOffre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="panneau_offre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PanneauOffre $panneauOffre): Response
    {
        $form = $this->createForm(PanneauOffreType::class, $panneauOffre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('panneau_offre_index');
        }

        return $this->render('panneau_offre/edit.html.twig', [
            'panneau_offre' => $panneauOffre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="panneau_offre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PanneauOffre $panneauOffre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$panneauOffre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($panneauOffre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('panneau_offre_index');
    }
}
