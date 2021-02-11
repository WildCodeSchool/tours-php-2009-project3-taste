<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\OrderRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function history(
        Request $request,
        PaginatorInterface $paginator
    ): Response {
        /**
         * @var User $user
         */
        $user = $this->getUser();
        $orders = $paginator->paginate(
            $user->getOrders(),
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('profile_user/history.html.twig', [
            'orders' => $orders
        ]);
    }
}
