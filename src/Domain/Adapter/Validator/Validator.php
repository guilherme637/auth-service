<?php

namespace App\Domain\Adapter\Validator;

use App\Infrastructure\Subscriber\Exception\Status400\BadRequestHttpException;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Validator implements ValidatorAdapterInterface
{
    public function __construct(private ValidatorInterface $validator) {}

    /**
     * @throws BadRequestHttpException
     */
    public function validate(object $object): void
    {
        $errors = $this->validator->validate($object);

        if (count($errors) > 0) {
            throw new BadRequestHttpException($errors[0]->getMessage());
        }
    }
}