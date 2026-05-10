<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\PlantNetAnalysisType;
use App\Service\IrrigationService;
use App\Service\PlantAnalysisService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/workspace')]
final class WorkspaceController extends AbstractController
{
    #[Route('', name: 'app_workspace_index', methods: ['GET'])]
    public function index(Request $request, IrrigationService $irrigationService): Response
    {
        $activeTab = (string) $request->query->get('tab', 'rotation');

        return $this->render('frontend/workspace/index.html.twig', [
            'activeTab' => $activeTab,
            'cultures' => $irrigationService->getSupportedCultures(),
            'plantNetForm' => $this->createForm(PlantNetAnalysisType::class)->createView(),
        ]);
    }

    #[Route('/tab/rotation', name: 'app_workspace_tab_rotation', methods: ['GET'])]
    public function rotationTab(): Response
    {
        return $this->renderWorkspaceTab('frontend/workspace/_rotation_tab.html.twig');
    }

    #[Route('/tab/meteo', name: 'app_workspace_tab_meteo', methods: ['GET'])]
    public function meteoTab(): Response
    {
        return $this->renderWorkspaceTab('frontend/workspace/_meteo_tab.html.twig');
    }

    #[Route('/tab/irrigation', name: 'app_workspace_tab_irrigation', methods: ['GET'])]
    public function irrigationTab(IrrigationService $irrigationService): Response
    {
        return $this->renderWorkspaceTab('frontend/workspace/_irrigation_tab.html.twig', [
            'cultures' => $irrigationService->getSupportedCultures(),
        ]);
    }

    #[Route('/tab/plantnet', name: 'app_workspace_tab_plantnet', methods: ['GET'])]
    public function plantNetTab(): Response
    {
        return $this->renderWorkspaceTab('frontend/workspace/_plantnet_tab.html.twig', [
            'plantNetForm' => $this->createForm(PlantNetAnalysisType::class)->createView(),
        ]);
    }

    #[Route('/plantnet/analyse', name: 'app_workspace_plantnet_analyse', methods: ['GET', 'POST'])]
    public function plantNetAnalyse(Request $request, PlantAnalysisService $plantAnalysisService): Response
    {
        if ($request->isMethod('GET')) {
            return $this->redirectToRoute('app_workspace_index', ['tab' => 'plantnet']);
        }

        $form = $this->createForm(PlantNetAnalysisType::class);
        $form->handleRequest($request);

        if (!$form->isSubmitted()) {
            return $this->json([
                'success' => false,
                'error' => 'Requete invalide.',
            ], Response::HTTP_BAD_REQUEST);
        }

        if (!$form->isValid()) {
            return $this->json([
                'success' => false,
                'error' => $this->firstFormError($form),
            ], Response::HTTP_BAD_REQUEST);
        }

        $image = $form->get('image')->getData();
        if (!$image instanceof UploadedFile) {
            return $this->json([
                'success' => false,
                'error' => 'Image manquante.',
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $analysisResult = $plantAnalysisService->analyze(
                image: $image,
                organ: (string) $form->get('organ')->getData(),
                language: (string) $form->get('language')->getData(),
                includeDiseases: (bool) $form->get('detectDiseases')->getData(),
                requestId: $request->headers->get('X-Request-Id'),
            );

            return $this->json([
                'success' => true,
                'data' => $analysisResult->toArray(),
            ]);
        } catch (\InvalidArgumentException $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        } catch (\RuntimeException $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_GATEWAY);
        } catch (\Throwable) {
            return $this->json([
                'success' => false,
                'error' => 'Erreur interne pendant l analyse PlantNet.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param array<string, mixed> $parameters
     */
    private function renderWorkspaceTab(string $view, array $parameters = []): Response
    {
        $response = $this->render($view, $parameters);
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');

        return $response;
    }

    private function firstFormError(FormInterface $form): string
    {
        foreach ($form->getErrors(true) as $error) {
            return $error->getMessage();
        }

        return 'Formulaire invalide.';
    }
}
