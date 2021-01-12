<?php

namespace App\Controller;

use App\Entity\Caterer;
use App\Form\CatererType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CatererController extends AbstractController
{
    /**
     * @Route("/caterer", name="caterer")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function catererPage(Request $request, EntityManagerInterface $entityManager): Response
    {
        $caterer = new Caterer();
        $form = $this->createForm(CatererType::class, $caterer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($caterer);
            $entityManager->flush();
            return $this->redirectToRoute('index');
        }
        return $this->render('caterer/caterer.html.twig', ["form" => $form->createView()]);
    }
}
