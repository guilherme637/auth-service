<?php

namespace App\Domain\Adapter\Redis;

interface RedisAdapterInterface
{
    public function setExpKey(string $key, int $expire, string $value): void;
    public function getTtl(string $key): ?int;
    public function getKey(string $key): array;
    public function get(string $key): ?string;
    public function getRedis(): \Redis;
}