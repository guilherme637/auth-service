<?php

namespace App\Infrastructure\Subscriber;

use App\Domain\Enum\CodeEnum;
use App\Infrastructure\Subscriber\Exception\Resolver\Resolver;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => [
                ['onResponse', 100],
                ['onLogin', 101]
            ]
        ];
    }

    public function onResponse(ExceptionEvent $event)
    {
        dump($event->getThrowable());exit();
        $resolver = new Resolver();
        $responseVO = $resolver->resolver($event->getThrowable());

        $event->setResponse(
            new JsonResponse(
                $responseVO->getResponse(),
                $responseVO->getCode()
            )
        );
    }

    public function onLogin(ExceptionEvent $event)
    {
        $request = $event->getRequest();
        $throwable = $event->getThrowable();

        if (
            str_contains($event->getRequest()->getPathInfo(), '/login')
            && $throwable->getCode() === CodeEnum::BAD_REQUEST->value
        ) {
            $request->getSession()->set('error', $throwable->getMessage());

            $event->setResponse(
                new RedirectResponse(
                    $request->server->get('HTTP_ORIGIN') . $request->server->get('REQUEST_URI')
                )
            );
        }
    }
}