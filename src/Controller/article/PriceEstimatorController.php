<?php
// src/Controller/article/PriceEstimatorController.php

namespace App\Controller\article;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Form\article\ImageUploadType;
use App\Service\article\ImagePriceEstimatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PriceEstimatorController extends AbstractController
{
    #[Route('/estimateur-prix', name: 'app_price_estimator')]
    public function index(Request $request, ImagePriceEstimatorService $estimator): Response
    {
        $form = $this->createForm(ImageUploadType::class);

        // Handle AJAX estimation request
        if ($request->isMethod('POST') && $request->isXmlHttpRequest()) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $imageFile */
                $imageFile = $form->get('image')->getData();

                $validationError = $this->validateImageFile($imageFile);
                if ($validationError) {
                    return $this->json(['error' => $validationError], 400);
                }

                $estimatedPrice = $estimator->estimatePrice($imageFile);

                if ($estimatedPrice === null) {
                    return $this->json([
                        'error' => 'Impossible de contacter l\'IA. Assurez-vous que Ollama est lancé et que le modèle qwen3-vl:4b est installé.'
                    ], 500);
                }

                return $this->json(['price' => $estimatedPrice]);
            }

            return $this->json(['error' => 'Formulaire invalide'], 400);
        }

        // For normal GET request: display the empty form
        return $this->render('price_estimator/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    private function validateImageFile(UploadedFile $file): ?string
    {
        $filename = $file->getClientOriginalName();
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

        if (!in_array($ext, $allowedExtensions)) {
            return 'Format de fichier non autorisé. Utilisez JPEG, PNG, WEBP ou GIF.';
        }

        $maxSize = 5 * 1024 * 1024; // 5MB
        if ($file->getSize() > $maxSize) {
            return 'Le fichier est trop volumineux. Taille maximale: 5MB.';
        }

        return null;
    }
}