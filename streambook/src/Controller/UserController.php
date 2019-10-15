<?php

namespace App\Controller;
use App\Entity\Categories;
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

        $categories = $this->getDoctrine()
            ->getRepository(Categories::class)
            ->findAll();

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
            'categories' => $categories,

        ]);
    }
}
