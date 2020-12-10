<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartnersController extends AbstractController
{
    /**
     * @Route("/partners", name="partners")
     */
    public function index(): Response
    {
        return $this->render('/partners.html.twig');
    }
}
