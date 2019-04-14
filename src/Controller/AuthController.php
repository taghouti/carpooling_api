<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AuthController extends AbstractController
{
    public function register(Request $request, UserPasswordEncoderInterface $encoder, ValidatorInterface $validator)
    {
        $username = $request->request->get('_username');
        $password = $request->request->get('_password');
        $email = $request->request->get('_email');

        $input = [
            'username' => $username,
            'password' => $password,
            'email' => $email
        ];

        $constraints = new Assert\Collection([
            'username' => [new Assert\Length(['min' => 4]), new Assert\NotBlank],
            'password' => [new Assert\Length(['min' => 4]), new Assert\NotBlank],
            'email' => [new Assert\Email(), new Assert\notBlank],
        ]);

        $violations = $validator->validate($input, $constraints);

        if (count($violations) > 0) {
            $accessor = PropertyAccess::createPropertyAccessor();
            $errorMessages = [];
            foreach ($violations as $violation) {
                $accessor->setValue($errorMessages,
                    $violation->getPropertyPath(),
                    $violation->getMessage());
            }
            return new Response(json_encode($errorMessages), Response::HTTP_INTERNAL_SERVER_ERROR,
                ['content-type' => 'text/plain']);
        }

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