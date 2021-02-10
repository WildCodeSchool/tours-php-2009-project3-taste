<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\CategoryRepository;
use App\Repository\CatererRepository;
use App\Repository\ClickRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminPageController
 * @package App\Controller
 * @Route("/admin", name="admin_")
 */
class AdminPageController extends AbstractController
{
    /**
     * @Route("/product", name="product", methods={"GET"})
     * @param Request $request
     * @param ProductRepository $productRepository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function productShow(
        Request $request,
        ProductRepository $productRepository,
        PaginatorInterface $paginator
    ): Response {

        $donnees = $productRepository->findby([], [
            'id' => 'DESC'
        ], null, null);
        $products = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('admin/product.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * @Route("/category", name="category", methods={"GET"})
     * @param Request $request
     * @param CategoryRepository $categoryRepository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function categoryShow(
        Request $request,
        CategoryRepository $categoryRepository,
        PaginatorInterface $paginator
    ): Response {

        $donnees = $categoryRepository->findAll();
        $categories = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('admin/category.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/caterer", name="caterer", methods={"GET"})
     * @param Request $request
     * @param CatererRepository $catererRepository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function catererShow(
        Request $request,
        CatererRepository $catererRepository,
        PaginatorInterface $paginator
    ): Response {

        $donnees = $catererRepository->findAll();
        $caterers = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('admin/caterer.html.twig', [
            'caterers' => $caterers
        ]);
    }

    /**
     * @Route("/click", name="click_index", methods={"GET"})
     * @param Request $request
     * @param ClickRepository $clickRepository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function clickShow(
        Request $request,
        ClickRepository $clickRepository,
        PaginatorInterface $paginator
    ): Response {

        $donnes = $clickRepository->findby([], [
            'id' => 'DESC'
        ]);
        $productClick = $paginator->paginate(
            $donnes,
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('admin/click.html.twig', [
            'productClick' => $productClick
        ]);
    }

    /**
     * @param Request $request
     * @param OrderRepository $orderRepository
     * @param PaginatorInterface $paginator
     * @return Response
     * @Route("/order", name="order")
     */
    public function orderShow(
        Request $request,
        OrderRepository $orderRepository,
        PaginatorInterface $paginator
    ): Response {

        $donnes = $orderRepository->findby([], [
            'id' => 'DESC'
        ]);
        $orders = $paginator->paginate(
            $donnes,
            $request->query->getInt('page', 1),
            4
        );
        return $this->render('admin/order.html.twig', [
            'orders' => $orders
        ]);
    }

    /**
     * @Route("/panier/validate/{id}/{order}", name="validate")
     * @param int $id
     * @param Order $order
     * @param EntityManagerInterface $entityManager
     * @param MailerInterface $mailer
     * @return RedirectResponse
     * @throws TransportExceptionInterface
     */
    public function isValidated(
        int $id,
        Order $order,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer
    ): RedirectResponse {
        $user = $order->getUser();
        if ($user !== null) {
            if ($id === 1) {
                $order->setIsValided(true);
                $entityManager->flush();

                $email = (new Email())
                    ->from('taste.mathieu@gmail.com')
                    ->to($user->getEmail())
                    ->subject('Votre commande est en cours préparation')
                    ->html('Vous pouvez venir cherché votre commande à ' . $order->getHours()->format('H:i'));
                $mailer->send($email);
            } elseif ($id === 0) {
                $order->setIsValided(false);
                $entityManager->flush();
                $email = (new Email())
                    ->from('taste.mathieu@gmail.com')
                    ->to($user->getEmail())
                    ->subject('Votre commande a été refuser')
                    ->html('Votre commande a été refuser, veuillez contacter la boutique au : 09 53 03 74 69');
                $mailer->send($email);
            } elseif ($id === 3) {
                $entityManager->remove($order);
                $entityManager->flush();
            }
        }
        return $this->redirectToRoute('admin_order');
    }
}
