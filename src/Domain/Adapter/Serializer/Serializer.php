<?php

namespace App\Domain\Adapter\Serializer;

class Serializer implements SerializerInterface
{
    public function __construct(private \JMS\Serializer\SerializerInterface $serializer) {}

    public function serialize(mixed $data, string $format): string
    {
        return $this->serializer->serialize($data,$format);
    }

    public function deserialize(string $data, string $type, string $format)
    {
        return $this->serializer->deserialize($data, $type, $format);
    }
}