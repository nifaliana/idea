<?php

namespace App\Controller;

use App\Entity\Confection;
use App\Form\ConfectionType;
use App\Repository\ConfectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/confection")
 */
class ConfectionController extends AbstractController
{
    /**
     * @Route("/", name="confection_index", methods={"GET"})
     */
    public function index(ConfectionRepository $confectionRepository): Response
    {
        return $this->render('confection/index.html.twig', [
            'confections' => $confectionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="confection_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $confection = new Confection();
        $form = $this->createForm(ConfectionType::class, $confection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($confection);
            $entityManager->flush();

            return $this->redirectToRoute('confection_index');
        }

        return $this->render('confection/new.html.twig', [
            'confection' => $confection,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="confection_show", methods={"GET"})
     */
    public function show(Confection $confection): Response
    {
        return $this->render('confection/show.html.twig', [
            'confection' => $confection,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="confection_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Confection $confection): Response
    {
        $form = $this->createForm(ConfectionType::class, $confection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('confection_index');
        }

        return $this->render('confection/edit.html.twig', [
            'confection' => $confection,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="confection_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Confection $confection): Response
    {
        if ($this->isCsrfTokenValid('delete'.$confection->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($confection);
            $entityManager->flush();
        }

        return $this->redirectToRoute('confection_index');
    }
}
