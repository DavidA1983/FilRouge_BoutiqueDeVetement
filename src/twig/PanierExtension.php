<?php

namespace App\Twig;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class PanierExtension extends AbstractExtension implements GlobalsInterface
{
    private $requestStack;
    private $produitRepository;

    public function __construct(RequestStack $requestStack, ProduitRepository $produitRepository)
    {
        $this->requestStack = $requestStack;
        $this->produitRepository = $produitRepository;
    }

    public function getGlobals(): array
    {
        $session = $this->requestStack->getSession();

        // 🛡️ Si la session n'est pas encore démarrée, on retourne des valeurs par défaut
        if (!$session) {
            return [
                'panier_count' => 0,
                'panier_total' => 0
            ];
        }

        $panier = $session->get('panier', []);
        $quantiteTotale = array_sum($panier);

        $total = 0;
        foreach ($panier as $id => $quantite) {
            $produit = $this->produitRepository->find($id);
            if ($produit) {
                $total += $produit->getPrix() * $quantite;
            }
        }

        return [
            'panier_count' => $quantiteTotale,
            'panier_total' => $total
        ];
    }
}
