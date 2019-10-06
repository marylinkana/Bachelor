<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StreambookController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render('streambook/index.html.twig', [
            'controller_name' => 'StreambookController',
        ]);
    }

    public function show($url)
    {
        return $this->render('streambook/index.html.twig', [
            'controller_name' => 'StreambookController',
        ]);
    }

    public function edit($id)
    {
        return $this->render('streambook/index.html.twig', [
            'controller_name' => 'StreambookController',
        ]);
    }

    public function remove($id)
    {
        return $this->render('streambook/index.html.twig', [
            'controller_name' => 'StreambookController',
        ]);
    }

    public function comment($id)
    {
        return $this->render('streambook/index.html.twig', [
            'controller_name' => 'StreambookController',
        ]);
    }

    public function summerize($id)
    {
        return $this->render('streambook/index.html.twig', [
            'controller_name' => 'StreambookController',
        ]);
    }


}
