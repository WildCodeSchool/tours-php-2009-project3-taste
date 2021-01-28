<?php

namespace App\Controller;

use App\Repository\ClickRepository;
use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="cart_")
 * Class ClickController
 * @package App\Controller
 */
class CartController extends AbstractController
{
    /**
     * @Route("/click-and-collect", name="index")
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

    /**
     * @Route("/cart/add/{id}", name="add")
     * @param int $id
     * @param CartService $cartService
     * @return RedirectResponse
     */
    public function clickAdd(int $id, CartService $cartService): RedirectResponse
    {
        $cartService->add($id);
        return $this->redirectToRoute('cart_index');
    }

    /**
     * @Route("/panier", name="show")
     * @param CartService $cartService
     * @return Response
     */
    public function cartShow(CartService $cartService): Response
    {
        return $this->render('click/cart.html.twig', [
            'items' =>  $cartService->getFullCart(),
            'total' => $cartService->getTotal()
        ]);
    }

    /**
     * @Route("/panier/remove/{id}", name="remove")
     * @param int $id
     * @param CartService $cartService
     * @return RedirectResponse
     */
    public function remove(int $id, CartService $cartService): RedirectResponse
    {
        $cartService->remove($id);
        return $this->redirectToRoute('cart_show');
    }
}
