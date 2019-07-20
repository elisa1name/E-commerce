<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Validation;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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

    public function registration(Request $request,ObjectManager $manager, UserPasswordEncoderInterface $encoder) {
        $user = new User();

        $content = json_decode(
            $request->getContent(),true
        );

        $validator = Validation::createValidator();

        $constraint = new Assert\Collection(array(
            // the keys correspond to the keys in the input array
            'password' => new Assert\Length(array('min' => 3, 'minMessage'=>'Votre mot de passe doit contenir minimum 3 caracteres')),
            'email' => new Assert\Email(array('message'=> 'Votre email est incorrect')),
            'firstname' => new Assert\Length(array('min' => 2, 'minMessage'=>'Votre prenom doit contenir minimum 2 caracteres')),
            'name' => new Assert\Length(array('min' => 2, 'minMessage'=>'Votre nom doit contenir minimum 2 caracteres')),
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
        // return $this->render('security/login.html.twig');
    }
    /** 
    *@Route("/deconnexion", name="security_logout")
    */

    public function logout() {}
    /** 
    *@Route("/api/profile", name="api-profile")
    */
    public function profile() 
    {
        
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $user = $this->getUser(); 

        $jsonContent = $serializer->serialize($user, 'json');
        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json');

        return $response; 
    }

    /** 
    *@Route("/api", name="api")
    */
    public function api()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $user = $this->get('security.token_storage')->getToken();

        $jsonContent = $serializer->serialize($user, 'json');
        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        
        return $response; 
    }

}
