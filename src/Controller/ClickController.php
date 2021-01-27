<?php

namespace App\Controller;

use App\Repository\ClickRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClickController extends AbstractController
{
    /**
     * @Route("/click-and-collect", name="click")
     * @param ClickRepository $click
     * @return Response
     */
    public function clickshow(ClickRepository $click): Response
    {
        return $this->render('click/product.html.twig', [
            'products' => $click->findby([], [
                'category' => 'ASC'
            ])
        ]);
    }
}
