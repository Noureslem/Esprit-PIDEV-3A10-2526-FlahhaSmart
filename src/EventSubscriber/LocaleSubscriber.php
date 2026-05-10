<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class LocaleSubscriber implements EventSubscriberInterface
{
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $request->setLocale('fr');
    }

    public static function getSubscribedEvents(): array
    {
        // Run early enough so Translator sees the correct locale.
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 20],
        ];
    }
}
