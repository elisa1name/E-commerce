<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

use App\Form\RegistrationType;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Validation;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
     * @Route("/register", name="register", methods= {"POST"})
     */

    public function registration(Request $request,ObjectManager $manager, UserPasswordEncoderInterface $encoder, ValidatorInterface $validator) {
        $user = new User();
        
        $content = json_decode(
            $request->getContent(),true
        );

        $validator = Validation::createValidator();

        $constraint = new Assert\Collection(array(
            // the keys correspond to the keys in the input array
            'password' => new Assert\Length(array('min' => 3, 'minMessage'=>'Votre mot de passe doit contenir minimum 3 caracteres')),
            'email' => new Assert\Email(array('message'=> 'Votre email est incorrect')),
            'firstname' => new Assert\Length(array('min' => 5, 'minMessage'=>'Votre prenom doit contenir minimum 5 caracteres')),
            'name' => new Assert\Length(array('min' => 5, 'minMessage'=>'Votre nom doit contenir minimum 5 caracteres')),
        ));

        $violations = $validator->validate($content, $constraint);

        if ($violations->count() > 0) {
            return new JsonResponse(["error" => (string)$violations], 500);
        }
        
        $email = $content['email'];
        $password = $content['password'];
        $name = $content['name'];
        $firstname = $content['firstname'];
       
        $user->setPassword($encoder->encodePassword($user, $password));
        $user->setEmail($email);
        $user->setname($name);
        $user->setRoles(['ROLE_USER']);
        $user->setfirstname($firstname);
        $user->setFixedDeliveryPrice(false);
        $manager->persist($user);
        $manager->flush();

        return new JsonResponse(["success" => $user->getEmail(). " est bien enregistré"], 200);
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
