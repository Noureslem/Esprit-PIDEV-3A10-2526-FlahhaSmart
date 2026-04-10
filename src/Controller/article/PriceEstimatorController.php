<?php

namespace App\Controller\article;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Form\article\ImageUploadType;
use App\Service\article\ImagePriceEstimatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PriceEstimatorController extends AbstractController
{
    #[Route('/estimateur-prix', name: 'app_price_estimator')]
    public function index(Request $request, ImagePriceEstimatorService $estimator): Response
    {
        $form = $this->createForm(ImageUploadType::class);
        $form->handleRequest($request);

        $estimatedPrice = null;
        $error = null;
        $imagePreview = null;

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $imageFile */
            $imageFile = $form->get('image')->getData();
            
            // Validate file extension and size
            $validationError = $this->validateImageFile($imageFile);
            if ($validationError) {
                $error = $validationError;
            } else {
                // Create a temporary preview (base64) for display
                // Get mime type from the original client filename extension
                $mimeType = $this->getMimeTypeFromFile($imageFile);
                $imageData = file_get_contents($imageFile->getPathname());
                $imagePreview = 'data:' . $mimeType . ';base64,' . base64_encode($imageData);

                $estimatedPrice = $estimator->estimatePrice($imageFile);
                
                if ($estimatedPrice === null) {
                    $error = 'Impossible de contacter l\'IA. Assurez-vous que Ollama est lancé et que le modèle qwen3-vl:4b est installé.';
                }
            }
        }

        return $this->render('price_estimator/index.html.twig', [
            'form' => $form->createView(),
            'estimatedPrice' => $estimatedPrice,
            'error' => $error,
            'imagePreview' => $imagePreview,
        ]);
    }

    private function validateImageFile($file): ?string
    {
        $filename = $file->getClientOriginalName();
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        
        // Validate extension
        if (!in_array($ext, $allowedExtensions)) {
            return 'Format de fichier non autorisé. Utilisez JPEG, PNG, WEBP ou GIF.';
        }
        
        // Validate file size (5MB max)
        $maxSize = 5 * 1024 * 1024; // 5MB
        if ($file->getSize() > $maxSize) {
            return 'Le fichier est trop volumineux. Taille maximale: 5MB.';
        }
        
        return null;
    }

    private function getMimeTypeFromFile($file): string
    {
        $filename = $file->getClientOriginalName();
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'webp' => 'image/webp',
            'gif' => 'image/gif',
        ];
        
        return $mimeTypes[$ext] ?? 'image/jpeg';
    }
}
