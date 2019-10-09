<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index()
    {
        $admin = 0;
        if (is_null($this->getUser())) {
            return $this->render('admin/index.html.twig', [
                'controller_name' => 'AdminController',
                'admin' => $admin
            ]);
        } else {
            $user = $this->getUser();
            $user_email = $this->getUser()->getEmail();
            $user_id = $this->getUser()->getId();
            return $this->render('admin/index.html.twig', [
                'controller_name' => 'AdminController',
                'user' => $user,
                'user_email' => $user_email,
                'user_id' => $user_id,
                'admin' => $admin
            ]);
        }
    }
}
