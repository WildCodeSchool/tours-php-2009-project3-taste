<?php

namespace App\Controller;

use App\Entity\Caterer;
use App\Form\CatererType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatererController extends AbstractController
{
    /**
     * @Route("/caterer", name="caterer")
     * @return Response
     */
    public function catererPage(): Response
    {
        $caterer = new Caterer();
        $form = $this->createForm(CatererType::class, $caterer);
        return $this->render('caterer/caterer.html.twig', ["form" => $form->createView()]);
    }
}
