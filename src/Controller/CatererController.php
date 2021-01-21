<?php

namespace App\Controller;

use App\Entity\Caterer;
use App\Form\CatererType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class CatererController extends AbstractController
{
    /**
     * @Route("/caterer", name="caterer")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param MailerInterface $mailer
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function catererPage(
        Request $request,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer
    ): Response {
        $caterer = new Caterer();
        $form = $this->createForm(CatererType::class, $caterer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($caterer);
            $entityManager->flush();

            $email = (new Email())
                ->from($this->getParameter('mailer_from'))
                ->to('taste.mathieu@gmail.com')
                ->subject('Une nouvelle demande de devis est arrivée!')
                ->html($this->renderView('caterer/catererMail.html.twig', ['caterer' => $caterer]));
            $mailer->send($email);
            return $this->redirectToRoute('index');
        }
        return $this->render('caterer/caterer.html.twig', ["form" => $form->createView()]);
    }
}
