<?php

namespace App\Controller;

use App\Entity\Variants;
use App\Form\VariantsType;
use App\Repository\VariantsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/variants")
 */
class VariantsController extends AbstractController
{
    /**
     * @Route("/", name="variants_index", methods={"GET"})
     */
    public function index(VariantsRepository $variantsRepository): Response
    {
        return $this->render('variants/index.html.twig', [
            'variants' => $variantsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="variants_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $variant = new Variants();
        $form = $this->createForm(VariantsType::class, $variant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($variant);
            $entityManager->flush();

            return $this->redirectToRoute('variants_index');
        }

        return $this->render('variants/new.html.twig', [
            'variant' => $variant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="variants_show", methods={"GET"})
     */
    public function show(Variants $variant): Response
    {
        return $this->render('variants/show.html.twig', [
            'variant' => $variant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="variants_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Variants $variant): Response
    {
        $form = $this->createForm(VariantsType::class, $variant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('variants_index', [
                'id' => $variant->getId(),
            ]);
        }

        return $this->render('variants/edit.html.twig', [
            'variant' => $variant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="variants_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Variants $variant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$variant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($variant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('variants_index');
    }
}
