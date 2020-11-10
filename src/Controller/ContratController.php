<?php

namespace App\Controller;

use App\Entity\Contrat;
use App\Form\ContratType;
use App\Repository\ContratRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contrat")
 */
class ContratController extends AbstractController
{
    /**
     * @Route("/", name="contrat_index", methods={"GET"})
     */
    public function index(ContratRepository $contratRepository): Response
    {
        return $this->render('contrat/index.html.twig', [
            'contrats' => $contratRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="contrat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contrat = new Contrat();
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager = $this->getDoctrine()->getManager();
            foreach ($contrat->getPayement() as $payement)
            {
                $payement->setContrat($contrat);
                $entityManager->persist($payement);
            }
            $entityManager->persist($contrat);
            $entityManager->flush();

            return $this->redirectToRoute('contrat_index');
        }

        return $this->render('contrat/new.html.twig', [
            'contrat' => $contrat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contrat_show", methods={"GET"})
     */
    public function show(Contrat $contrat): Response
    {
        return $this->render('contrat/show.html.twig', [
            'contrat' => $contrat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contrat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Contrat $contrat): Response
    {
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($contrat->getPayement() as $payement)
            {
                $payement->setContrat($contrat);
                $entityManager->persist($payement);
            }
            $entityManager->flush();
            return $this->redirectToRoute('contrat_index');
            $this->addFlash('success', "Modification avec success");
        }

        return $this->render('contrat/edit.html.twig', [
            'contrat' => $contrat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contrat_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Contrat $contrat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contrat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contrat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contrat_index');
    }
}
