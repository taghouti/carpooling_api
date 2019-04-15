<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class InputValidation
 * @package App\Service
 */
class InputValidation
{
    /**
     * This function will validated any request inputs
     * @param ValidatorInterface $validator
     * @param Request $request
     * @param array $input
     * @param string $method
     * @return null|Response
     */
    public function validateRequestData(ValidatorInterface $validator, Request $request, $input = array(), $method = 'get')
    {
        $data = $constraints = array();

        foreach ($input as $key => $constraint) {
            $data[$key] = $request->request->$method($key);
            $constraints[$key] = is_array($constraint) ? $constraint : array($constraint);
        }

        $constraints = new Assert\Collection($constraints);

        $violations = $validator->validate($data, $constraints);

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

        return null;
    }
}
