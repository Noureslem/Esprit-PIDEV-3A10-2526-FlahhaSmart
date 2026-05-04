<?php
// src/Controller/article/CartController.php

namespace App\Controller\article;

use App\Entity\article\Article;
use App\Entity\article\Order;
use App\Entity\article\OrderLine;
use App\Repository\article\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cart')]
class CartController extends AbstractController
{
    #[Route('/', name: 'app_cart_index')]
    public function index(SessionInterface $session, ArticleRepository $articleRepo): Response
    {
        $cart = $session->get('cart', []);
        $cartData = [];
        $total = 0;

        if (!empty($cart)) {
            // Conversion des clés en entiers
            $ids = array_map('intval', array_keys($cart));
            $articles = $articleRepo->findByIds($ids);
            // Indexer par id pour retrouver rapidement
            $articlesById = [];
            foreach ($articles as $article) {
                $articlesById[$article->getId()] = $article;
            }

            foreach ($cart as $id => $quantity) {
                $article = $articlesById[(int)$id] ?? null;
                if ($article) {
                    $subtotal = (float) $article->getPrix() * $quantity;
                    $total += $subtotal;
                    $cartData[] = [
                        'article' => $article,
                        'quantity' => $quantity,
                        'subtotal' => $subtotal,
                    ];
                }
            }
        }

        return $this->render('cart/index.html.twig', [
            'cart' => $cartData,
            'total' => $total,
        ]);
    }

    #[Route('/add/{id}', name: 'app_cart_add')]
    public function add(int $id, Request $request, SessionInterface $session, ArticleRepository $repo): Response
    {
        $article = $repo->find($id);
        if (!$article) {
            $this->addFlash('error', 'Article introuvable.');
            return $this->redirectToRoute('app_article_index');
        }

        $cart = $session->get('cart', []);
        $quantity = $request->query->getInt('quantity', 1);

        if ($quantity > $article->getStock()) {
            $this->addFlash('error', 'Stock insuffisant.');
            return $this->redirectToRoute('app_article_show', ['id' => $id]);
        }

        if (isset($cart[$id])) {
            $newQty = $cart[$id] + $quantity;
            if ($newQty > $article->getStock()) {
                $this->addFlash('error', 'Quantité totale dépasse le stock.');
                return $this->redirectToRoute('app_article_show', ['id' => $id]);
            }
            $cart[$id] = $newQty;
        } else {
            $cart[$id] = $quantity;
        }

        $session->set('cart', $cart);
        $this->addFlash('success', 'Article ajouté au panier.');
        return $this->redirectToRoute('app_cart_index');
    }

    #[Route('/remove/{id}', name: 'app_cart_remove')]
    public function remove(int $id, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            $session->set('cart', $cart);
            $this->addFlash('success', 'Article retiré du panier.');
        }
        return $this->redirectToRoute('app_cart_index');
    }

    #[Route('/update/{id}/{quantity}', name: 'app_cart_update')]
    public function update(int $id, int $quantity, SessionInterface $session, ArticleRepository $repo): Response
    {
        $article = $repo->find($id);
        if (!$article) {
            return $this->redirectToRoute('app_cart_index');
        }

        if ($quantity <= 0) {
            return $this->redirectToRoute('app_cart_remove', ['id' => $id]);
        }

        if ($quantity > $article->getStock()) {
            $this->addFlash('error', 'Stock disponible insuffisant.');
            return $this->redirectToRoute('app_cart_index');
        }

        $cart = $session->get('cart', []);
        $cart[$id] = $quantity;
        $session->set('cart', $cart);
        $this->addFlash('success', 'Quantité mise à jour.');
        return $this->redirectToRoute('app_cart_index');
    }

    #[Route('/checkout/submit', name: 'app_cart_checkout_submit', methods: ['POST'])]
    public function checkoutSubmit(Request $request, SessionInterface $session, EntityManagerInterface $em, ArticleRepository $articleRepo): Response
    {
        // Récupération des champs du formulaire modal avec cast string
        $statut = (string) $request->request->get('statut');
        $modePaiement = (string) $request->request->get('modePaiement');
        $adresse = (string) $request->request->get('adresse');

        // Validation simple
        if (empty($statut) || empty($modePaiement) || empty($adresse)) {
            $this->addFlash('error', 'Tous les champs sont obligatoires.');
            return $this->redirectToRoute('app_cart_index');
        }

        $cart = $session->get('cart', []);
        if (empty($cart)) {
            $this->addFlash('error', 'Votre panier est vide.');
            return $this->redirectToRoute('app_article_index');
        }

        // Convertir les clés du panier en entiers pour findByIds
        $ids = array_map('intval', array_keys($cart));
        $articles = $articleRepo->findByIds($ids);
        // Indexer par id
        $articlesById = [];
        foreach ($articles as $article) {
            $articlesById[$article->getId()] = $article;
        }

        // Génération d'une référence unique pour la commande
        $reference = 'REF-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
        $fraisLivraison = random_int(10, 50);

        $order = new Order();
        $order->setReference($reference);
        $order->setDateCommande(new \DateTime());
        $order->setStatut($statut);
        $order->setModePaiement($modePaiement);
        $order->setAdresseLivraison($adresse);
        $order->setFraisLivraison($fraisLivraison);

        $user = $this->getUser();
        $order->setIdUser($user instanceof \App\Entity\User ? $user->getId() : null);

        $totalArticles = 0;

        foreach ($cart as $id => $qty) {
            $article = $articlesById[(int)$id] ?? null;
            if (!$article || $qty > $article->getStock()) {
                $this->addFlash('error', "Stock insuffisant pour l'article ID $id");
                return $this->redirectToRoute('app_cart_index');
            }

            $line = new OrderLine();
            $line->setArticle($article);
            $line->setQuantity($qty);
            $line->setPriceAtOrder($article->getPrix());
            $order->addOrderLine($line);

            $article->setStock($article->getStock() - $qty);
            $totalArticles += (float) $article->getPrix() * $qty;
        }

        $order->setMontantTotal($totalArticles + $fraisLivraison);

        $em->persist($order);
        $em->flush();

        $session->remove('cart');

        $this->addFlash('success', "Commande validée ! Référence : $reference - Frais de livraison : $fraisLivraison €");
        return $this->redirectToRoute('app_order_index');
    }
}