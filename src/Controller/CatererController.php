<?php

namespace App\Controller;

use App\Entity\Caterer;
use App\Form\CatererType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CatererController extends AbstractController
{
    /**
     * @Route("/caterer", name="caterer")
     * @param Request $request
     * @return Response
     */
    public function catererPage(Request $request): Response
    {
        $caterer = new Caterer();
        $form = $this->createForm(CatererType::class, $caterer);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($caterer);
            $entityManager->flush();
            return $this->redirectToRoute('index');
        }
        return $this->render('caterer/caterer.html.twig', ["form" => $form->createView()]);
    }
}
