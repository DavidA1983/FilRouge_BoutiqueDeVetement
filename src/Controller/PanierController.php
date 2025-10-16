<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/panier', name: 'app_panier_')]
class PanierController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, ProduitRepository $produitRepository): Response
    {
        $panier = $session->get('panier', []);

        $panierAvecDetails = [];
        $total = 0;

        foreach ($panier as $id => $quantite) {
            $produit = $produitRepository->find($id);
            if ($produit) {
                $panierAvecDetails[] = [
                    'produit' => $produit,
                    'quantite' => $quantite,
                    'total' => $produit->getPrix() * $quantite,
                ];
                $total += $produit->getPrix() * $quantite;
            }
        }

        return $this->render('panier/index.html.twig', [
            'panier' => $panierAvecDetails,
            'total' => $total,
        ]);
    }

    #[Route('/ajouter/{id}', name: 'ajouter')]
public function ajouter($id, SessionInterface $session, Request $request): Response
{
    $panier = $session->get('panier', []);

    if (!empty($panier[$id])) {
        $panier[$id]++;
    } else {
        $panier[$id] = 1;
    }

    $session->set('panier', $panier);

    // ✅ Message flash de confirmation
    $this->addFlash('success', '✅ Produit ajouté au panier !');

    // ✅ Redirection vers la page catégorie (adapte le nom de ta route si besoin)
     return $this->redirect($request->headers->get('referer'));
}


    #[Route('/supprimer/{id}', name: 'supprimer')]
    public function supprimer($id, SessionInterface $session): Response
    {
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_panier_index');
    }

    #[Route('/vider', name: 'vider')]
    public function vider(SessionInterface $session): Response
    {
        $session->remove('panier');

        return $this->redirectToRoute('app_panier_index');
    }
}
