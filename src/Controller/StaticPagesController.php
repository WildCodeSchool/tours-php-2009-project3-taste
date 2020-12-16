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
}
