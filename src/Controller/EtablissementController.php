<?php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Repository\EtablissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/etablissements')]
class EtablissementController extends AbstractController
{
    private $etablissementRepository;

    public function __construct(EtablissementRepository $etablissementRepository)
    {
        $this->etablissementRepository = $etablissementRepository;
    }

    /**
     * Liste de tous les établissements
     */
    #[Route('/', name: 'app_etablissement_index', methods: ['GET'])]
    public function index(): Response
    {
        $etablissements = $this->etablissementRepository->findAll();

        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissements,
            'title' => 'Tous les établissements'
        ]);
    }

    /**
     * Affiche les détails d'un établissement
     */
    #[Route('/{id}', name: 'app_etablissement_show', methods: ['GET'])]
    public function show(Etablissement $etablissement): Response
    {
        return $this->render('etablissement/show.html.twig', [
            'etablissement' => $etablissement,
        ]);
    }

    /**
     * Liste des établissements par département
     */
    #[Route('/departement/{codeDepartement}', name: 'app_etablissement_by_departement', methods: ['GET'])]
    public function listByDepartement(string $codeDepartement): Response
    {
        $etablissements = $this->etablissementRepository->findBy(['codeDepartement' => $codeDepartement]);
        
        // Si des établissements ont été trouvés, on utilise le nom du premier pour le titre
        $departementName = !empty($etablissements) ? $etablissements[0]->getDepartement() : 'Département ' . $codeDepartement;

        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissements,
            'title' => 'Établissements du département ' . $departementName
        ]);
    }

    /**
     * Liste des établissements par région
     */
    #[Route('/region/{codeRegion}', name: 'app_etablissement_by_region', methods: ['GET'])]
    public function listByRegion(string $codeRegion): Response
    {
        $etablissements = $this->etablissementRepository->findBy(['codeRegion' => $codeRegion]);
        
        $regionName = !empty($etablissements) ? $etablissements[0]->getRegion() : 'Région ' . $codeRegion;

        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissements,
            'title' => 'Établissements de la région ' . $regionName
        ]);
    }

    /**
     * Liste des établissements par commune
     */
    #[Route('/commune/{codeCommune}', name: 'app_etablissement_by_commune', methods: ['GET'])]
    public function listByCommune(string $codeCommune): Response
    {
        $etablissements = $this->etablissementRepository->findBy(['codeCommune' => $codeCommune]);
        
        $communeName = !empty($etablissements) ? $etablissements[0]->getCommune() : 'Commune ' . $codeCommune;

        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissements,
            'title' => 'Établissements de la commune de ' . $communeName
        ]);
    }

    /**
     * Liste des établissements par académie
     */
    #[Route('/academie/{codeAcademie}', name: 'app_etablissement_by_academie', methods: ['GET'])]
    public function listByAcademie(string $codeAcademie): Response
    {
        $etablissements = $this->etablissementRepository->findBy(['codeAcademie' => $codeAcademie]);
        
        $academieName = !empty($etablissements) ? $etablissements[0]->getAcademie() : 'Académie ' . $codeAcademie;

        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissements,
            'title' => 'Établissements de l\'académie de ' . $academieName
        ]);
    }

    /**
     * Liste des établissements par secteur (public/privé)
     */
    #[Route('/secteur/{secteur}', name: 'app_etablissement_by_secteur', methods: ['GET'])]
    public function listBySecteur(string $secteur): Response
    {
        $etablissements = $this->etablissementRepository->findBy(['secteur' => $secteur]);
        
        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissements,
            'title' => 'Établissements du secteur ' . $secteur
        ]);
    }

    /**
     * Liste des établissements par type (collège, lycée, etc.)
     */
    #[Route('/type/{type}', name: 'app_etablissement_by_type', methods: ['GET'])]
    public function listByType(string $type): Response
    {
        $etablissements = $this->etablissementRepository->findBy(['denominationPrincipale' => $type]);
        
        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissements,
            'title' => 'Établissements de type ' . $type
        ]);
    }
}
