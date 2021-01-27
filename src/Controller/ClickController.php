<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClickController extends AbstractController
{
    /**
     * @Route("/click-and-collect", name="click")
     */
    public function clickshow(ProductRepository $product): Response
    {
        return $this->render('click/product.html.twig', [
            'products' => $product->findby([], [
                'category' => 'ASC'
            ])
        ]);
    }
}
