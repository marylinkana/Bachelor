<?php

namespace App\Controller;

use App\Entity\Books;
use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index()
    {
        if (is_null($this->getUser())) {
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
            ]);
        }
        else{
            $user = $this->getUser();
            $user_email = $this->getUser()->getEmail();
            $user_id = $this->getUser()->getId();
            $books = $this->getDoctrine()
                ->getRepository(Books::class)
                ->findAll();
            $categories = $this->getDoctrine()
                ->getRepository(Categories::class)
                ->findAll();
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
                'user' => $user,
                'user_email' => $user_email,
                'user_id' => $user_id,
                'books' => $books,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * @Route("/{cat}", name="app_home/{cat}")
     */
    public function category($cat)
    {
        if (is_null($this->getUser())) {
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
            ]);
        }
        else{
            $user = $this->getUser();
            $user_email = $this->getUser()->getEmail();
            $user_id = $this->getUser()->getId();
            $books = $this->getDoctrine()
                ->getRepository(Books::class)
                ->findByExampleField($cat);
            $categories = $this->getDoctrine()
                ->getRepository(Categories::class)
                ->findAll();
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
                'user' => $user,
                'user_email' => $user_email,
                'user_id' => $user_id,
                'books' => $books,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * @Route("/readBook/{id}", name="app_readBook/{id}")
     */
    public function readBook($id)
    {
        if (is_null($this->getUser())) {
            return $this->render('home/readBook.html.twig', [
                'controller_name' => 'HomeController',
            ]);
        }
        else{
            $user = $this->getUser();
            $user_email = $this->getUser()->getEmail();
            $user_id = $this->getUser()->getId();
            $books = $product = $this->getDoctrine()
                ->getRepository(Books::class)
                ->find($id);
            if (!empty($books)) {
                $title = $books->getTitle();
                $description = $books->getDescription();
                $content = $books->getContent();
                $url = $books->getUrl();
            }else{
                throw $this->createNotFoundException(
                    'No product found for id '.$id
                );
            }
            return $this->render('home/readBook.html.twig', [
                'controller_name' => 'HomeController',
                'user' => $user,
                'user_email' => $user_email,
                'user_id' => $user_id,
                'books' => $books,
                'bookTitle' => $title,
                'bookDescription' => $description,
                'bookContent' => $content,
                'bookUrl' => $url,
            ]);
        }
    }
}
