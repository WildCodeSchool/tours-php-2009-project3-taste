<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    /**
     * @Route("/session", name="session")
     * @param SessionInterface $session
     * @return Response
     */
    public function index(SessionInterface $session): Response
    {
        if (!$session->has('total')) {
            $session->set('total', 0);
        }
        $session->get('total');
        return $this->render('session/session.html.twig');
    }
}
