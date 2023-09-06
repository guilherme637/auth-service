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

    public function fromArray(array $data, string $type): object
    {
        return $this->serializer->fromArray($data, $type);
    }

    public function toArray(object $data): array
    {
        return $this->serializer->toArray($data);
    }
}