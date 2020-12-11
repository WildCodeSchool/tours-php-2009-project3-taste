<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }
    /**
     * @Route("/FAQ", name="FAQ")
     * @return Response
     */
    public function pageF(): Response
    {
        return $this->render('FAQ-CGU/faq.html.twig');
    }

    /**
     * @Route("/CGU", name="CGU")
     * @return Response
     */
    public function pageC(): Response
    {
        return $this->render('FAQ-CGU/cgu.html.twig');
    }
}
