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

        // If route explicitly sets a locale, keep it.
        $routeLocale = $request->attributes->get('_locale');
        if (is_string($routeLocale) && $routeLocale !== '') {
            $request->setLocale($routeLocale);

            return;
        }

        $sessionLocale = null;
        if ($request->hasSession()) {
            $session = $request->getSession();
            $sessionLocale = $session->get('_locale');
        }

        if (is_string($sessionLocale) && $sessionLocale !== '') {
            $request->setLocale($sessionLocale);

            return;
        }

        $cookieLocale = $request->cookies->get('_locale');
        if (\is_string($cookieLocale) && \in_array($cookieLocale, ['fr', 'en', 'ar'], true)) {
            $request->setLocale($cookieLocale);
        }
    }

    public static function getSubscribedEvents(): array
    {
        // Run early enough so Translator sees the correct locale.
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 20],
        ];
    }
}
