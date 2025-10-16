<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/categorie')]
final class CategorieController extends AbstractController
{
    #[Route('/homme', name: 'app_categorie_homme', methods: ['GET'])]
    public function homme(CategorieRepository $repo): Response
    {
        $categorie = $repo->findOneBy(['nom' => 'Homme']);
        if (!$categorie) {
            throw $this->createNotFoundException('Catégorie Homme non trouvée.');
        }

        return $this->render('categorie/show.html.twig', [
            'categorie' => $categorie,
            'produits' => $categorie->getProduits(),
        ]);
    }

    #[Route('/femme', name: 'app_categorie_femme', methods: ['GET'])]
    public function femme(CategorieRepository $repo): Response
    {
        $categorie = $repo->findOneBy(['nom' => 'Femme']);
        if (!$categorie) {
            throw $this->createNotFoundException('Catégorie Femme non trouvée.');
        }

        return $this->render('categorie/show.html.twig', [
            'categorie' => $categorie,
            'produits' => $categorie->getProduits(),
        ]);
    }

    #[Route('/enfant', name: 'app_categorie_enfant', methods: ['GET'])]
    public function enfant(CategorieRepository $repo): Response
    {
        $categorie = $repo->findOneBy(['nom' => 'Enfant']);
        if (!$categorie) {
            throw $this->createNotFoundException('Catégorie Enfant non trouvée.');
        }

        return $this->render('categorie/show.html.twig', [
            'categorie' => $categorie,
            'produits' => $categorie->getProduits(),
        ]);
    }
    #[Route('/categorie/produit/{id}', name: 'app_categorie_detail')]
public function detail($id, ProduitRepository $produitRepository): Response
{
    $produit = $produitRepository->find($id);

    if (!$produit) {
        throw $this->createNotFoundException('Produit non trouvé');
    }

    return $this->render('categorie/detail.html.twig', [
        'produit' => $produit
    ]);
}
}
