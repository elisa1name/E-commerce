<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="security")
     */
    public function index()
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

     /**
     * @Route("/inscription", name="security_registration")
     */

    public function registration(Request $request,ObjectManager $manager, UserPasswordEncoderInterface $encoder) {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user,$user->getPassword());

            $user->setPassword($hash);
            $user->setRoles(['ROLE_ADMIN']);
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security_login');
           
        }


        return $this->render('security/registration.html.twig',[
            'form'=> $form->createView()
        ]);
    }

    /** 
    *@Route("/connexion", name="security_login")
    */

    public function login() {
        return $this->render('security/login.html.twig');
    }
    /** 
    *@Route("/deconnexion", name="security_logout")
    */

    public function logout() {}

    /** 
    *@Route("/profile/{id}", name="security_profile")
    */

    public function profile(User $user) 
    {
          return $this->render('security/profile.html.twig', [
            'user' => $user,
        ]);

    }

}
