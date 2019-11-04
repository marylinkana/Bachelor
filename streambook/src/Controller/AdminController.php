<?php

namespace App\Controller;

use App\Entity\Books;
use App\Entity\Categories;
use App\Entity\Comments;
use App\Entity\Page;
use App\Entity\User;
use App\Form\AddBookToCategoryFormType;
use App\Form\AddUserToAdminFormType;
use App\Form\CreateBookFormType;
use App\Form\CreateCategoryFormType;
use App\Form\CreatePageForBookFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


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

            $categories = $this->getDoctrine()
                ->getRepository(Categories::class)
                ->findAll();
            return $this->render('admin/index.html.twig', [
                'controller_name' => 'AdminController',
                'user' => $user,
                'user_email' => $user_email,
                'user_id' => $user_id,
                'admin' => $admin,
                'categories' => $categories,

            ]);
        }
    }

    /**
     * @Route("/newbook", name="app_newbook")
     */
    public function createBookForm(Request $request): Response
    {
        $user = $this->getUser();
        $user_email = $this->getUser()->getEmail();
        $user_id = $this->getUser()->getId();

        $book = new Books();
        $book_form = $this->createForm(CreateBookFormType::class, $book);
        $book_form->handleRequest($request);

        $categories = $this->getDoctrine()
            ->getRepository(Categories::class)
            ->findAll();

        if ($book_form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();
            return $this->redirectToRoute('app_home');
        }

        return $this->render('admin/createBook.html.twig', [
            'bookForm' => $book_form->createView(),
            'user' => $user,
            'user_email' => $user_email,
            'user_id' => $user_id,
            'categories' => $categories,

        ]);
    }

    /**
     * @Route("/newcategory", name="app_newcategory")
     */
    public function createCategoryForm(Request $request): Response
    {
        $user = $this->getUser();
        $user_email = $this->getUser()->getEmail();
        $user_id = $this->getUser()->getId();

        $category = new categories();
        $category_form = $this->createForm(CreateCategoryFormType::class, $category);
        $category_form->handleRequest($request);

        $categories = $this->getDoctrine()
            ->getRepository(categories::class)
            ->findAll();

        if ($category_form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/createCategory.html.twig', [
            'categoryForm' => $category_form->createView(),
            'user' => $user,
            'user_email' => $user_email,
            'user_id' => $user_id,
            'categories' => $categories,

        ]);
    }

    /**
     * @Route("/newUserToAdmin", name="app_newUserToAdmin")
     */
    public function newUserToAdmin(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(AddUserToAdminFormType::class, $user);
        $form->handleRequest($request);

        $allUsers = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        $categories = $this->getDoctrine()
            ->getRepository(Categories::class)
            ->findAll();

        $thisUser = $this->getUser();

        if (isset($_POST['submit_add_admin'])) {

            $user= $this->getDoctrine()
                ->getRepository(User::class)
                ->find($_POST['id']);

            // stay whit same last name
            $user->setName($user->getName());
            // stay whit same last email
            $user->setEmail($user->getEmail());
            // stay whit same last password
            $user->setPassword($user->getPassword());
            // Update level
            $user->setLevel(1);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

        }

        if (isset($_POST['submit_delete_admin'])) {
            $user= $this->getDoctrine()
                ->getRepository(User::class)
                ->find($_POST['id']);

            $user->setLevel(0);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

        }

        if (isset($_POST['submit_delete'])) {
            $user= $this->getDoctrine()
                ->getRepository(User::class)
                ->find($_POST['id']);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();

        }

        if (isset($_POST['submit_ban'])) {
            $user= $this->getDoctrine()
                ->getRepository(User::class)
                ->find($_POST['id']);

            $user->setLevel(-1);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

        }

        return $this->render('admin/AddUserToAdmin.html.twig', [
            'adminForm' => $form->createView(),
            'allUsers' => $allUsers,
            'user' => $thisUser,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/newBookToCategory", name="app_newBookToCategory")
     */
    public function newBookToCategory(Request $request): Response
    {
        $book = new Books();
        $category = new Categories();
        $form = $this->createForm(AddBookToCategoryFormType::class, $book);
        $form->handleRequest($request);

        $allBooks = $this->getDoctrine()
            ->getRepository(Books::class)
            ->findAll();


        $allCategories = $this->getDoctrine()
            ->getRepository(Categories::class)
            ->findAll();

        $thisUser = $this->getUser();

        if (isset($_POST['submit_add_book_to_category'])) {
            $category= $this->getDoctrine()
                ->getRepository(Categories::class)
                ->find($_POST['id_cat']);

            $book->addCategory($category);

            $book= $this->getDoctrine()
                ->getRepository(Books::class)
                ->find($_POST['id_book']);

            // stay whit same last email
            $category->addBook($book);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->persist($category);
            $entityManager->flush();

        }
        if (isset($_POST['submit_remove_book_to_category'])) {
                $book->removeCategory($_POST['id_cat']);

                $book= $this->getDoctrine()
                    ->getRepository(Books::class)
                    ->find($_POST['id_book']);

                // stay whit same last email
                $category->removeBook($book->getId());

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($book);
                $entityManager->persist($category);
                $entityManager->flush();

        }

        return $this->render('admin/AddBookToCategory.html.twig', [
            'form' => $form->createView(),
            'allBooks' => $allBooks,
            'user' => $thisUser,
            'allCategories' => $allCategories,
        ]);
    }

    /**
     * @Route("/newPageForBook", name="app_newPageForBook")
     */
    public function newPageForBook(Request $request): Response
    {
        $page = new Page();
        $form = $this->createForm(CreatePageForBookFormType::class, $page);
        $form->handleRequest($request);

        $allBooks = $this->getDoctrine()
            ->getRepository(Books::class)
            ->findAll();

        $allCategories = $this->getDoctrine()
            ->getRepository(Categories::class)
            ->findAll();

        $thisUser = $this->getUser();


        if (isset($_POST['submit_add_page_for_book'])) {
            $book= $this->getDoctrine()
                ->getRepository(Books::class)
                ->find($_POST['id_book']);

            $page->setIdBook($book);
            $page->setContent($_POST['content']);
            $page->setTitle($_POST['title']);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($page);
            $entityManager->flush();
        }

        return $this->render('admin/createPageForBook.html.twig', [
            'form' => $form->createView(),
            'allBooks' => $allBooks,
            'user' => $thisUser,
            'allCategories' => $allCategories,
        ]);
    }

    /**
     * @Route("/adminComment", name="app_adminComment")
     */
    public function adminComment(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(AddUserToAdminFormType::class, $user);
        $form->handleRequest($request);

        $allUsers = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        $categories = $this->getDoctrine()
            ->getRepository(Categories::class)
            ->findAll();

        $comments = $this->getDoctrine()
            ->getRepository(Comments::class)
            ->findAll();

        $thisUser = $this->getUser();

        if (isset($_POST['submit_delete'])) {
            $comment= $this->getDoctrine()
                ->getRepository(Comments::class)
                ->find($_POST['id']);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comment);
            $entityManager->flush();

        }

        return $this->render('admin/AdminComments.html.twig', [
            'adminForm' => $form->createView(),
            'allUsers' => $allUsers,
            'user' => $thisUser,
            'categories' => $categories,
            'comments' => $comments
        ]);
    }




}
