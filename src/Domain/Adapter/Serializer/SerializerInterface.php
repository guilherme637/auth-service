<?php

namespace App\Domain\Adapter\Serializer;

interface SerializerInterface
{
    public function serialize($data, string $format): string;
    public function deserialize(string $data, string $type, string $format);
    public function fromArray(array $data, string $type);
    public function toArray(object $data): array;
}