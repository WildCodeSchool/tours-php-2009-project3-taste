<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\User;
use App\Form\OrderType;
use App\Repository\ClickRepository;
use App\Service\Cart\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
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
     * @param Request $request
     * @param CartService $cartService
     * @param EntityManagerInterface $entityManager
     * @param MailerInterface $mailer
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function cartShow(
        Request $request,
        CartService $cartService,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer
    ): Response {
        $order = new Order();
        /** @var User $user */
        $user = $this->getUser();
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $order->setCart($cartService->getFullCart());
            $order->setPriceTotal($cartService->getTotal());
            $order->setUser($user);
            $entityManager->persist($order);
            $entityManager->flush();

            $email = (new Email())
                ->from('taste.mathieur@gmail.com')
                ->to($user->getUsername())
                ->to('taste.mathieu@gmail.com')
                ->subject('Votre commande #' . $order->getId() . ' est en cours de validation')
                ->html('<p>Votre commande n°' . $order->getId() . ' sera valider prochainement</p>');
            $mailer->send($email);

            $cartService->cartRemove();

            $this->addFlash('success', 'Commande Envoyée');
            return $this->redirect($request->server->get('HTTP_REFERER'));
        }
        return $this->render('click/cart.html.twig', [
            'items' => $cartService->getFullCart(),
            'total' => $cartService->getTotal(),
            "form" => $form->createView()
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
