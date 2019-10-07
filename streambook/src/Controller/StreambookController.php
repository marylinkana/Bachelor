<?php

namespace App\Controller;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

class StreambookController extends AbstractController
{
    /**
     * @Route("/home", name="accueil")
     */
    public function index()
    {
        return $this->render('streambook/index.html.twig', [
            'controller_name' => 'StreambookController',
        ]);
    }

    public function add() : Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $book = new Book();
        $book->setTitle('BIBLE');
        $book->setDescription('Livre chretien');
        $book->setLanguage('Français');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($book);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new book with id '.$book->getId().' Titre : '.$book->getTitle());
    }

    public function login()
    {
        return $this->render('streambook/index.html.twig', [
            'controller_name' => 'StreambookController',
        ]);
    }

    public function logout()
    {
        return $this->render('streambook/index.html.twig', [
            'controller_name' => 'StreambookController',
        ]);
    }

    public function cathegories()
    {
        return $this->render('streambook/index.html.twig', [
            'controller_name' => 'StreambookController',
        ]);
    }

    public function cathegorie($id)
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
