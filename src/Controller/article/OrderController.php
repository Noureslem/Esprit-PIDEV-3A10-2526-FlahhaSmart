<?php
namespace App\Controller\article;

use App\Entity\article\Order;
use App\Form\article\OrderType;
use App\Repository\article\OrderRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/order')]
class OrderController extends AbstractController
{
    #[Route('/', name: 'app_order_index', methods: ['GET'])]
    public function index(OrderRepository $repository, Request $request): Response
    {
        $search = $request->query->get('search', '');
        $sort = $request->query->get('sort', 'id');

        if ($search) {
            $orders = $repository->searchByReference($search);
        } else {
            $orders = $repository->findAll();
        }

        // Sorting
        usort($orders, function($a, $b) use ($sort) {
            switch ($sort) {
                case 'date_desc': return $b->getDateCommande() <=> $a->getDateCommande();
                case 'date_asc': return $a->getDateCommande() <=> $b->getDateCommande();
                case 'amount_asc': return $a->getMontantTotal() <=> $b->getMontantTotal();
                case 'amount_desc': return $b->getMontantTotal() <=> $a->getMontantTotal();
                case 'ref_asc': return strcasecmp($a->getReference(), $b->getReference());
                case 'ref_desc': return strcasecmp($b->getReference(), $a->getReference());
                default: return $b->getId() <=> $a->getId();
            }
        });

        return $this->render('order/index.html.twig', [
            'orders' => $orders,
            'search' => $search,
            'sort' => $sort,
        ]);
    }

    #[Route('/new', name: 'app_order_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($order);
            $em->flush();
            $this->addFlash('success', 'Commande ajoutée avec succès.');
            return $this->redirectToRoute('app_order_index');
        }

        return $this->render('order/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_order_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Order $order, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Commande modifiée avec succès.');
            return $this->redirectToRoute('app_order_index');
        }

        return $this->render('order/edit.html.twig', [
            'form' => $form->createView(),
            'order' => $order,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_order_delete', methods: ['POST'])]
    public function delete(Request $request, Order $order, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$order->getId(), $request->request->get('_token'))) {
            $em->remove($order);
            $em->flush();
            $this->addFlash('success', 'Commande supprimée avec succès.');
        }
        return $this->redirectToRoute('app_order_index');
    }

    #[Route('/statistiques/montant', name: 'app_order_stats_amount', methods: ['GET'])]
    public function statsAmount(OrderRepository $repository): Response
    {
        $orders = $repository->findAll();
        $max = 0;
        $min = PHP_INT_MAX;
        $sum = 0;
        foreach ($orders as $o) {
            $m = $o->getMontantTotal();
            if ($m > $max) $max = $m;
            if ($m < $min) $min = $m;
            $sum += $m;
        }
        $avg = count($orders) ? $sum / count($orders) : 0;
        $total = $sum;

        // montant ranges
        $ranges = [
            '0-50 €' => 0,
            '50-100 €' => 0,
            '100-200 €' => 0,
            '200-500 €' => 0,
            '500+ €' => 0,
        ];
        foreach ($orders as $o) {
            $m = $o->getMontantTotal();
            if ($m <= 50) $ranges['0-50 €']++;
            elseif ($m <= 100) $ranges['50-100 €']++;
            elseif ($m <= 200) $ranges['100-200 €']++;
            elseif ($m <= 500) $ranges['200-500 €']++;
            else $ranges['500+ €']++;
        }

        // top 10 by amount
        $top = $orders;
        usort($top, fn($a, $b) => $b->getMontantTotal() <=> $a->getMontantTotal());
        $top = array_slice($top, 0, 10);

        return $this->render('order/stats_amount.html.twig', [
            'orders' => $orders,
            'max' => $max,
            'min' => $min,
            'avg' => $avg,
            'total' => $total,
            'ranges' => $ranges,
            'top' => $top,
        ]);
    }

    #[Route('/statistiques/frais', name: 'app_order_stats_fees', methods: ['GET'])]
    public function statsFees(OrderRepository $repository): Response
    {
        $orders = $repository->findAll();
        $max = 0;
        $min = PHP_INT_MAX;
        $sum = 0;
        foreach ($orders as $o) {
            $f = $o->getFraisLivraison();
            if ($f > $max) $max = $f;
            if ($f < $min) $min = $f;
            $sum += $f;
        }
        $avg = count($orders) ? $sum / count($orders) : 0;
        $total = $sum;

        // frais ranges
        $ranges = [
            '0-5 €' => 0,
            '5-10 €' => 0,
            '10-15 €' => 0,
            '15-20 €' => 0,
            '20+ €' => 0,
        ];
        foreach ($orders as $o) {
            $f = $o->getFraisLivraison();
            if ($f <= 5) $ranges['0-5 €']++;
            elseif ($f <= 10) $ranges['5-10 €']++;
            elseif ($f <= 15) $ranges['10-15 €']++;
            elseif ($f <= 20) $ranges['15-20 €']++;
            else $ranges['20+ €']++;
        }

        // quartiles
        $sorted = $orders;
        usort($sorted, fn($a, $b) => $a->getFraisLivraison() <=> $b->getFraisLivraison());
        $count = count($sorted);
        $q1 = $sorted[floor($count/4)]->getFraisLivraison() ?? 0;
        $median = $sorted[floor($count/2)]->getFraisLivraison() ?? 0;
        $q3 = $sorted[floor(3*$count/4)]->getFraisLivraison() ?? 0;

        return $this->render('order/stats_fees.html.twig', [
            'orders' => $sorted,
            'max' => $max,
            'min' => $min,
            'avg' => $avg,
            'total' => $total,
            'ranges' => $ranges,
            'q1' => $q1,
            'median' => $median,
            'q3' => $q3,
        ]);
    }
}