<?php

namespace App\Controller;

use App\Service\IrrigationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/workspace')]
class WorkspaceController extends AbstractController
{
    #[Route('', name: 'app_workspace_index', methods: ['GET'])]
    public function index(Request $request, IrrigationService $irrigationService): Response
    {
        $activeTab = $request->query->get('tab', 'rotation');

        return $this->render('frontend/workspace/index.html.twig', [
            'activeTab' => $activeTab,
            'cultures' => $irrigationService->getSupportedCultures(),
        ]);
    }

    #[Route('/tab/rotation', name: 'app_workspace_tab_rotation', methods: ['GET'])]
    public function rotationTab(): Response
    {
        return $this->render('frontend/workspace/_rotation_tab.html.twig');
    }

    #[Route('/tab/meteo', name: 'app_workspace_tab_meteo', methods: ['GET'])]
    public function meteoTab(): Response
    {
        return $this->render('frontend/workspace/_meteo_tab.html.twig');
    }

    #[Route('/tab/irrigation', name: 'app_workspace_tab_irrigation', methods: ['GET'])]
    public function irrigationTab(IrrigationService $irrigationService): Response
    {
        return $this->render('frontend/workspace/_irrigation_tab.html.twig', [
            'cultures' => $irrigationService->getSupportedCultures(),
        ]);
    }
}
