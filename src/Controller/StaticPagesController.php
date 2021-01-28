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
    public function indexFaq(): Response
    {
        return $this->render('static/faq.html.twig');
    }

    /**
     * @Route("/CGU", name="CGU")
     * @return Response
     */
    public function indexCgu(): Response
    {
        return $this->render('static/cgu.html.twig');
    }

    /**
     * This method is used to display the partner page
     * @Route("/partners", name="partners")
     * @return Response
     */
    public function indexPartners(): Response
    {
        return $this->render('static/partners.html.twig');
    }

    /**
     * @return Response
     * @Route("/news", name="news")
     */
    public function instaShow()
    {
        return $this->render('insta/index.html.twig');
    }
}
