<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
    /**
     * @Route("/carte", name="carte")
     * @param CategoryRepository $category
     * @return Response
     */
    public function carteMenu(CategoryRepository $category): Response
    {

        return $this->render('carte/cartemenu.html.twig', [
            'categories' => $category->findWithProducts()
            ]);
    }
}
