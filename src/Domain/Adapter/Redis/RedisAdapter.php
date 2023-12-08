<?php

namespace App\Domain\Adapter\Redis;

class RedisAdapter implements RedisAdapterInterface
{
    private \Redis $redis;

    public function __construct(string $host)
    {
        $this->redis = new \Redis();
        $this->redis->connect($host);
    }

    public function getRedis(): \Redis
    {
        return $this->redis;
    }

    /**
     * @throws \RedisException
     */
    public function setExpKey(string $key, int $expire, string $value): void
    {
        $this->redis->setex($key, $expire, $value);
    }

    /**
     * @throws \RedisException
     */
    public function getTtl(string $key): ?int
    {
        return $this->redis->ttl($key);
    }

    /**
     * @throws \RedisException
     */
    public function getKey(string $key): array
    {
        return $this->redis->keys($key);
    }

    /**
     * @throws \RedisException
     */
    public function get(string $key): ?string
    {
        return $this->redis->get($key);
    }
}