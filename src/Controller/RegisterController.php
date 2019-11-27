<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\RegisterType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RegisterController extends AbstractController
{

  /**
   * @Route("/register", name="register")
   */
  public function register(Request $request, UserPasswordEncoderInterface $encoder): Response
  {
    $user = new User();
    $form = $this->createForm(RegisterType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $password = $user->getPassword();
      $encodedPassword = $encoder->encodePassword($user, $password);
      $user->setPassword($encodedPassword);
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($user);
      $entityManager->flush();

      return $this->redirectToRoute('user_index');
    }

    return $this->render('user/register.html.twig', [
      'user' => $user,
      'form' => $form->createView(),
    ]);
  }
}
