<?php

namespace App\Controller\Front;

use App\Entity\StockProduit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/client/produits')]
class ClientController extends AbstractController
{
    private $httpClient;
    private $openRouterApiKey;
    private $usdaApiKey;
    
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->openRouterApiKey = $_ENV['OPENROUTER_API_KEY'] ?? 
                                  $_SERVER['OPENROUTER_API_KEY'] ?? 
                                  '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';
        $this->usdaApiKey = $_ENV['USDA_API_KEY'] ?? $_SERVER['USDA_API_KEY'] ?? '';
    }
    
    #[Route('', name: 'client_produit_index', methods: ['GET'])]
    public function index(Request $request, EntityManagerInterface $entityManager, PaginatorInterface $paginator): Response
    {
        $search = $request->query->get('search', '');
        $status = $request->query->get('status', 'all'); 
        $page = $request->query->getInt('page', 1);
        
        $qb = $entityManager->createQueryBuilder()
            ->select('s')
            ->from(StockProduit::class, 's')
            ->leftJoin('s.user', 'u');
        
        if ($search !== '') {
            $qb->andWhere('s.typeProduit LIKE :search OR s.variete LIKE :search OR u.nom LIKE :search')
               ->setParameter('search', '%' . $search . '%');
        }
        
        if ($status !== 'all') {
            $qb->andWhere('s.statut = :status')
               ->setParameter('status', $status);
        }
        
        $qb->orderBy('s.idProduit', 'DESC');
        
        $stocks = $paginator->paginate(
            $qb->getQuery(),
            $page,
            4
        );
        
        $allStocks = $entityManager->getRepository(StockProduit::class)->findAll();
        $stats = [
            'en_cours' => 0,
            'termine' => 0,
            'en_croissance' => 0,
            'total' => count($allStocks)
        ];
        foreach ($allStocks as $stock) {
            $statut = strtolower($stock->getStatut() ?? '');
            if ($statut === 'en cours' || $statut === 'en_cours') {
                $stats['en_cours']++;
            } elseif ($statut === 'terminé' || $statut === 'termine') {
                $stats['termine']++;
            } elseif ($statut === 'en croissance' || $statut === 'en_croissance') {
                $stats['en_croissance']++;
            }
        }
        
        return $this->render('front/client/index.html.twig', [
            'stocks' => $stocks,
            'stats' => $stats,
            'currentSearch' => $search,
            'currentStatus' => $status,
        ]);
    }

    #[Route('/{idProduit}', name: 'client_produit_show', methods: ['GET'])]
    public function show($idProduit, EntityManagerInterface $entityManager): Response
    {
        $stock = $entityManager->getRepository(StockProduit::class)->find($idProduit);
        
        if (!$stock) {
            throw $this->createNotFoundException('Produit non trouvé');
        }
        
        // Utilisation du QueryBuilder Doctrine DBAL (au lieu de prepare() manuel)
        $conn = $entityManager->getConnection();
        $qb = $conn->createQueryBuilder();
        $qb->select('*')
           ->from('consommation_produit')
           ->where('id_stock_produit = :idStock')
           ->setParameter('idStock', $idProduit);
        
        $consommations = $qb->executeQuery()->fetchAllAssociative();
        
        $nutrition = $this->getNutritionalInfo($stock->getTypeProduit() ?? $stock->getNomProduit() ?? '');
        
        return $this->render('front/client/detailsnutri.html.twig', [
            'stock' => $stock,
            'consommations' => $consommations,
            'nutrition' => $nutrition,
        ]);
    }
    
    private function getNutritionalInfo(string $productName): array
    {
        if (empty($productName) || empty($this->usdaApiKey)) {
            return $this->getEmptyNutrition();
        }

        $searchTerm = urlencode($productName);
        $url = "https://api.nal.usda.gov/fdc/v1/foods/search?query={$searchTerm}&pageSize=1&api_key={$this->usdaApiKey}";

        try {
            $response = $this->httpClient->request('GET', $url, [
                'timeout' => 10,
            ]);

            $data = $response->toArray();
            
            if (empty($data['foods']) || !is_array($data['foods'])) {
                return $this->getEmptyNutrition();
            }

            $food = $data['foods'][0];
            $nutrients = $food['foodNutrients'] ?? [];
            
            $nutritionData = [];
            foreach ($nutrients as $nutrient) {
                $name = strtolower($nutrient['nutrientName'] ?? '');
                $value = $nutrient['value'] ?? null;
                
                if (str_contains($name, 'energy') || str_contains($name, 'calories')) {
                    $nutritionData['energy_kcal'] = $value;
                } elseif (str_contains($name, 'protein')) {
                    $nutritionData['protein'] = $value;
                } elseif (str_contains($name, 'total lipid') || str_contains($name, 'fat')) {
                    $nutritionData['fat'] = $value;
                } elseif (str_contains($name, 'carbohydrate')) {
                    $nutritionData['carbohydrates'] = $value;
                } elseif (str_contains($name, 'fiber')) {
                    $nutritionData['fiber'] = $value;
                } elseif (str_contains($name, 'sugar')) {
                    $nutritionData['sugars'] = $value;
                } elseif (str_contains($name, 'sodium')) {
                    $nutritionData['salt'] = $value; 
                }
            }
            
            return [
                'energy_kcal'     => $nutritionData['energy_kcal'] ?? null,
                'fat'             => $nutritionData['fat'] ?? null,
                'saturated_fat'   => null, 
                'carbohydrates'   => $nutritionData['carbohydrates'] ?? null,
                'sugars'          => $nutritionData['sugars'] ?? null,
                'protein'         => $nutritionData['protein'] ?? null,
                'fiber'           => $nutritionData['fiber'] ?? null,
                'salt'            => $nutritionData['salt'] ?? null,
                'product_name'    => $food['description'] ?? $productName,
                'brand'           => $food['brandOwner'] ?? null,
                'image_url'       => null, 
            ];
        } catch (\Exception $e) {
            error_log('Erreur API USDA : ' . $e->getMessage());
            return $this->getEmptyNutrition();
        }
    }

    private function getEmptyNutrition(): array
    {
        return [
            'energy_kcal' => null,
            'fat' => null,
            'saturated_fat' => null,
            'carbohydrates' => null,
            'sugars' => null,
            'protein' => null,
            'fiber' => null,
            'salt' => null,
            'product_name' => null,
            'brand' => null,
            'image_url' => null,
        ];
    }
}