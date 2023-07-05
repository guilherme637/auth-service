<?php

namespace App\Infrastructure\Subscriber\Exception\Resolver;

use App\Domain\VO\ResponseVO;
use App\Infrastructure\Subscriber\Exception\Status500\InternalServerHttpException;

abstract class ResolverAbstract implements ResolverHandlerInterface
{
    private ?ResolverHandlerInterface $handler = null;

    public function setNext(ResolverHandlerInterface $handler): ResolverHandlerInterface
    {
        $this->handler = $handler;

        return $handler;
    }

    public function handle(\Throwable $throwable): ?ResponseVO
    {
        if ($this->shoudCall($throwable)) {
            $nameClass = get_class($this);
            $instanceOfNameClass = new $nameClass();

            return $instanceOfNameClass($throwable);
        }

        return !is_null($this->handler)
            ? $this->handler->handle($throwable)
            : new ResponseVO($_ENV['APP_ENV'] !== 'prod' ? $throwable : new InternalServerHttpException());
    }

    abstract public function shoudCall(\Throwable $throwable): bool;

    public function __invoke(\Throwable $throwable): ResponseVO
    {
        return new ResponseVO($throwable);
    }
}