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
     */
    public function carteMenu(): Response
    {
        /** @var CategoryRepository $repository */
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->findWithProducts();

        return $this->render('carte/cartemenu.html.twig', ['categories' => $categories]);
    }
}
