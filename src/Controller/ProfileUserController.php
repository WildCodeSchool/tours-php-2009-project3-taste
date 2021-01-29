<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\User;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileUserController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     * @param OrderRepository $orderRepository
     * @return Response
     */
    public function index(OrderRepository $orderRepository): Response
    {
        /**
         * @var User $user
         */
        $user = $this->getUser();

        $orders = $orderRepository->findBy([
            "id" => $user->getId()
        ]);

        return $this->render('profile_user/index.html.twig', [
            'user' => $user,
            'orders' => $orders
        ]);
    }
}
