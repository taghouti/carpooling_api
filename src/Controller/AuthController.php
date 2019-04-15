<?php

namespace App\Controller;

use App\Service\InputValidation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AuthController extends AbstractController
{
    public function register(InputValidation $validation, Request $request, UserPasswordEncoderInterface $encoder, ValidatorInterface $validator)
    {
        $validation = $validation->validateRequestData($validator, $request,
            [
                'username' => [new Assert\Length(['min' => 4]), new Assert\NotBlank],
                'password' => [new Assert\Length(['min' => 4]), new Assert\NotBlank],
                'email' => [new Assert\Email(), new Assert\notBlank]
            ]
        );

        if ($validation) return $validation;

        $username = $request->request->get('username');
        $password = $request->request->get('password');
        $email = $request->request->get('email');

        $user = new User();
        $user->setPassword($encoder->encodePassword($user, $password));
        $user->setEmail($email);
        $user->setUsername($username);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return new Response(sprintf('User %s successfully created', $user->getUsername()),
            Response::HTTP_OK,
            ['content-type' => 'text/plain']);
    }

    public function api()
    {
        return new Response(sprintf('Logged in as %s', $this->getUser()->getUsername()));
    }
}