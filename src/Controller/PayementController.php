<?php

namespace App\Controller;

use App\Entity\Payement;
use App\Form\PayementType;
use App\Repository\PayementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/payement")
 */
class PayementController extends AbstractController
{
    /**
     * @Route("/", name="payement_index", methods={"GET"})
     */
    public function index(PayementRepository $payementRepository): Response
    {
        return $this->render('payement/index.html.twig', [
            'payements' => $payementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="payement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $payement = new Payement();
        $form = $this->createForm(PayementType::class, $payement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($payement);
            $entityManager->flush();

            return $this->redirectToRoute('payement_index');
        }

        return $this->render('payement/new.html.twig', [
            'payement' => $payement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="payement_show", methods={"GET"})
     */
    public function show(Payement $payement): Response
    {
        return $this->render('payement/show.html.twig', [
            'payement' => $payement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="payement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Payement $payement): Response
    {
        $form = $this->createForm(PayementType::class, $payement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('payement_index');
        }

        return $this->render('payement/edit.html.twig', [
            'payement' => $payement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="payement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Payement $payement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$payement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($payement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('payement_index');
    }
}
