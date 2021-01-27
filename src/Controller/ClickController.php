<?php

namespace App\Controller;

use App\Repository\ClickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ClickController extends AbstractController
{
    /**
     * @Route("/click-and-collect", name="click")
     * @param ClickRepository $click
     * @param SessionInterface $session
     * @param ClickRepository $clickRepository
     * @return Response
     */
    public function clickshow(
        ClickRepository $click,
        SessionInterface $session,
        ClickRepository $clickRepository
    ): Response {
        $cart = $session->get('cart', []);
        $cartWidthData = [];

        foreach ($cart as $id => $quantity) {
            $cartWidthData [] = [
                'product' => $clickRepository->find($id),
                'quantity' => $quantity
            ];
        }

        dd($cartWidthData);
        return $this->render('click/product.html.twig', [
            'products' => $click->findby([], [
                'category' => 'ASC'
            ])
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="add_cart")
     * @param SessionInterface $session
     * @param int $id
     */
    public function clickAdd(SessionInterface $session, int $id): void
    {
        $cart = $session->get('cart', []);

        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }
        $session->set('cart', $cart);

        dd($session->get('cart'));
    }
}
