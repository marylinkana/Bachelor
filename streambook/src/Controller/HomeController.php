<?php

namespace App\Controller;

use App\Entity\Books;
use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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

            $books = $this->getDoctrine()
                ->getRepository(Books::class)
                ->findAll();

            $categories = $this->getDoctrine()
                ->getRepository(Categories::class)
                ->findAll();
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
                'user' => $user,
                'books' => $books,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * @Route("/category/{cat}", name="app_category")
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

            $books = $this->getDoctrine()
                ->getRepository(Books::class)
                ->findByIdJoinedToCategory($cat);

            $categories = $this->getDoctrine()
                ->getRepository(Categories::class)
                ->findAll();
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
                'user' => $user,
                'books' => $books,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * @Route("/search", name="app_search")
     */
    public function search()
    {
        if (!isset($_POST['search']) && !empty($_POST['searchValue'])) {
            echo 'bonjour';
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
            ]);
        }
        $user = $this->getUser();

        $books = $this->getDoctrine()
            ->getRepository(Books::class)
            ->findLikeExampleField($_POST['searchValue']);

        $categories = $this->getDoctrine()
            ->getRepository(Categories::class)
            ->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'user' => $user,
            'books' => $books,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/readBook/{id}", name="app_readBook")
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

            $books = $product = $this->getDoctrine()
                ->getRepository(Books::class)
                ->find($id);
            $categories = $this->getDoctrine()
                ->getRepository(Categories::class)
                ->findAll();
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
                'categories' => $categories,
                'books' => $books,
                'bookTitle' => $title,
                'bookDescription' => $description,
                'bookContent' => $content,
                'bookUrl' => $url,
            ]);
        }
    }
}
