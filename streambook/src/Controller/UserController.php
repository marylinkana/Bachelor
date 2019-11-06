<?php

namespace App\Controller;
use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends AbstractController
{
    /**
     * @Route("/user", name="app_user")
     */
    public function index(UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = $this->getUser();

        $categories = $this->getDoctrine()
            ->getRepository(Categories::class)
            ->findAll();

        $myReadPages = $user->getPages();

        if(isset($_POST['changeName'])){
            $user->setName($_POST['userName']);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        }
        if(isset($_POST['changeEmail'])){
            $user->setEmail($_POST['userEmail']);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        }
        if(isset($_POST['changePassword'])){
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $_POST['userPassword']
                )
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        }

        foreach ($myReadPages as $k => $myReadPage){
            $myReadBooks[$myReadPage->getId()] = $myReadPage->getIdBook();
            $myReadBookView[$myReadPage->getIdBook()->getId()] = $myReadPage->getIdBook();
            $myIdReadPages[$myReadPage->getId()] = $myReadPage->getId();
        }

        foreach ($myReadBooks as $k => $myReadBook){
            $booksPages[$myReadBook->getId()] = $myReadBook->getPages();
        }

        foreach ($booksPages as $k => $bookPages) {
            $nb = 0;
            foreach ($bookPages as $bookPage) {
                $bookPageId = $bookPage->getId();
                $idBooks[$k] = $bookPage->getIdBook()->getId();
                $totalBookPage[$idBooks[$k]] = count($bookPages);
                foreach ($myIdReadPages as $myIdReadPage) {
                    if ($bookPageId == $myIdReadPage) {
                        $nb ++;
                        $moving[$idBooks[$k]] = $nb ;
                    }
                }
            }
        }
        foreach ($idBooks as $idBook){
            $readPercent[$idBook] = ($moving[$idBook] * 100) / $totalBookPage[$idBook];
        }


        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
            'categories' => $categories,
            'myReadBooks' => $myReadBookView,
            'readPercents' => $readPercent,
        ]);
    }
}
