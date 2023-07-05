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
        $collectionErrors = new ArrayCollection();

        if (count($errors) > 0) {
<<<<<<< Updated upstream
            /** @var ConstraintViolation $error */
            foreach ($errors as $error) {
                $collectionErrors->add(
                    '{{' . $error->getPropertyPath() . '}} ' . $error->getMessage()
                );
            }
=======
            throw new BadRequestHttpException($errors->get(0)->getMessage());
>>>>>>> Stashed changes
        }

        throw new BadRequestHttpException(
            implode(', ', $collectionErrors->toArray())
        );
    }
}