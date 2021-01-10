<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Category;
use App\Repository\CategoryRepository;
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
     * @Route("/carte", name="carte")
     * @return Response
     */
    public function carteMenu(): Response
    {
        /** @var CategoryRepository $repository */
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->findWithProducts();
        return $this->render('static/carte.html.twig', ['categories' => $categories]);
    }
}
