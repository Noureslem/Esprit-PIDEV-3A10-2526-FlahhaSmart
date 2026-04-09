<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class LocaleController extends AbstractController
{
    #[Route('/locale/{_locale}', name: 'app_locale_switch', methods: ['GET'], requirements: ['_locale' => 'fr|en|ar'])]
    public function switch(string $_locale, Request $request): RedirectResponse
    {
        if ($request->hasSession()) {
            $request->getSession()->set('_locale', $_locale);
        }

        $cookie = Cookie::create(
            '_locale',
            $_locale,
            new \DateTimeImmutable('+1 year')
        )->withPath('/')
         ->withSecure($request->isSecure())
         ->withSameSite('lax');

        $referer = $request->headers->get('referer');
        if (is_string($referer) && $referer !== '') {
            $host = $request->getSchemeAndHttpHost();
            if (str_starts_with($referer, $host)) {
                $response = new RedirectResponse($referer);
                $response->headers->setCookie($cookie);

                return $response;
            }
        }

        if ($this->getUser() !== null) {
            $response = $this->redirectToRoute('app_dashboard_index');
            $response->headers->setCookie($cookie);

            return $response;
        }

        $response = $this->redirectToRoute('app_login');
        $response->headers->setCookie($cookie);

        return $response;
    }
}
