<?php

namespace App\Service\Cart;

use App\Repository\ClickRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    protected SessionInterface $session;
    protected ClickRepository $clickRepository;

    public function __construct(SessionInterface $session, ClickRepository $clickRepository)
    {
        $this->session = $session;
        $this->clickRepository = $clickRepository;
    }

    public function add(int $id): void
    {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }
        $this->session->set('cart', $cart);
    }

    public function remove(int $id): void
    {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }

        $this->session->set('cart', $cart);
    }

    /**
     * @return array[]
     */
    public function getFullCart(): array
    {
        $cart = $this->session->get('cart', []);
        $cartWidthData = [];

        foreach ($cart as $id => $quantity) {
            $cartWidthData [] = [
                'product' => $this->clickRepository->find($id),
                'quantity' => $quantity
            ];
        }
        return $cartWidthData;
    }

    public function getTotal(): float
    {
        $total = 0;
        foreach ($this->getFullCart() as $item) {
            $totalItem = $item['product']->getPrice() * $item['quantity'];
            $total += $totalItem;
        }
        return $total;
    }
}
