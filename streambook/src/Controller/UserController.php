<?php

namespace App\Controller;
use http\Client\Curl\User;
use http\Client\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="app_user")
     */
    public function index()
    {
        $user = $this->getUser();
        $user_email = $this->getUser()->getEmail();
        $user_id = $this->getUser()->getId();
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
            'user_email' => $user_email,
            'user_id' => $user_id,
        ]);
    }
}
