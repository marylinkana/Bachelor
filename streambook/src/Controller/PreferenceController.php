<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PreferenceController extends AbstractController
{
    /**
     * @Route("/preference", name="preference")
     */
    public function index()
    {
        return $this->render('preference/index.html.twig', [
            'controller_name' => 'PreferenceController',
        ]);
    }

    public function add()
    {
        return new Response('<h1>Ajouter un article</h1>');
    }

    public function show($url)
    {
        return $this->render('preference/index.html.twig', [
            'controller_name' => 'PreferenceController',
        ]);    }

    public function remove($id)
    {
        return $this->render('preference/index.html.twig', [
            'controller_name' => 'PreferenceController',
        ]);    }
}
