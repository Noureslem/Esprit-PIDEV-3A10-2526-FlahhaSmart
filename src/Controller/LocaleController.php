<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class LocaleController extends AbstractController
{
    #[Route('/locale/{_locale}', name: 'app_locale_switch', methods: ['GET'], requirements: ['_locale' => 'fr|en|ar'])]
    public function switch(string $_locale, Request $request): RedirectResponse
    {
        $request->getSession()->set('_locale', $_locale);

        $referer = $request->headers->get('referer');
        if (is_string($referer) && $referer !== '') {
            return new RedirectResponse($referer);
        }

        return $this->redirectToRoute('app_dashboard_index');
    }
}
