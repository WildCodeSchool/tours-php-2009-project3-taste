<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProfileUserController
 * @package App\Controller
 * @Route ("/profil", name="profil_")
 */
class ProfileUserController extends AbstractController
{
    /**
     * @Route("/", name="index")
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

    /**
     * @Route("/history", name="history")
     * @param OrderRepository $orderRepository
     * @return Response
     */
    public function history(OrderRepository $orderRepository): Response
    {
        /**
         * @var User $user
         */
        $user = $this->getUser();
        $orders = $orderRepository->findBy(
            ["id" => $user->getId()],
        );

        return $this->render('profile_user/history.html.twig', [
            'user' => $user,
            'orders' => $orders
        ]);
    }
}
