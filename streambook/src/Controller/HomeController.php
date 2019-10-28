<?php

namespace App\Controller;

use App\Entity\Books;
use App\Entity\Categories;
use App\Entity\Comments;
use App\Entity\Page;
use App\Entity\User;
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
                'ws_url' => 'localhost:8080',

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
     * @Route("/read", name="app_read")
     */
    public function read($pageRead){
        $user = $this->getUser();
        $page = $this->getDoctrine()
            ->getRepository(Page::class)
            ->find($pageRead);
        $page->addUser($user);
        $user->addPage($page);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($page);
        $entityManager->persist($user);
        $entityManager->flush();
    }

    /**
     * @Route("/readBook/{id}", name="app_readBook")
     */
    public function readBook($id)
    {
        $user = $this->getUser();
        if(isset($_POST['submit_comment'])){

            $book = $this->getDoctrine()
                ->getRepository(Books::class)
                ->find($_POST['bookId']);
            $date = new \DateTime('now');
            $comment = new Comments();
            $comment->setContent($_POST['content']);
            $comment->setdate($date);
            $comment->setUser($user);
            $comment->setBooks($book);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
        }
        if (is_null($this->getUser())) {
            return $this->render('home/readBook.html.twig', [
                'controller_name' => 'HomeController',
            ]);
        }
        else{
            $book = $product = $this->getDoctrine()
                ->getRepository(Books::class)
                ->findOneByIdField($id);

            $pages = $this->getDoctrine()
                ->getRepository(Page::class)
                ->findByExampleField($id);

            $categories = $this->getDoctrine()
                ->getRepository(Categories::class)
                ->findAll();

            $comments = $this->getDoctrine()
                ->getRepository(Comments::class)
                ->findAll();
            if (isset($_POST['read'])){
                $user = $this->getUser();
                $page = $this->getDoctrine()
                    ->getRepository(Page::class)
                    ->find($_POST['pageRead']);
                $page->addUser($user);
                $user->addPage($page);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($page);
                $entityManager->persist($user);
                $entityManager->flush();
            }
            if (empty($book)) {

                throw $this->createNotFoundException(
                    'No book found for id '.$id
                );
            }
            return $this->render('home/readBook.html.twig', [
                'controller_name' => 'HomeController',
                'user' => $user,
                'categories' => $categories,
                'book' => $book,
                'pages' => $pages,
                'comments' => $comments,
            ]);
        }

    }
}
