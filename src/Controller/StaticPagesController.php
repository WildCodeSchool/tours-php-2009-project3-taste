<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * This class is used to display all static views
 * @package App\Controller
 */
class StaticPagesController extends AbstractController
{
    /**
     * This method is used to display the home page
     * @return Response
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('static/index.html.twig');
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
