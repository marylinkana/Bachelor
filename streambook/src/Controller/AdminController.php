<?php

namespace App\Controller;

use App\Entity\Books;
use App\Entity\Categories;
use App\Form\CreateBookFormType;
use App\Form\CreateCategoryFormType;
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
            return $this->render('admin/index.html.twig', [
                'controller_name' => 'AdminController',
                'user' => $user,
                'user_email' => $user_email,
                'user_id' => $user_id,
                'admin' => $admin
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

        $category = new Categories();
        $category_form = $this->createForm(CreateCategoryFormType::class, $category);
        $category_form->handleRequest($request);

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
        ]);
    }
}
