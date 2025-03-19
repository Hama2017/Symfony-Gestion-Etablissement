<?php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Repository\EtablissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/etablissements')]
class EtablissementController extends AbstractController
{
    private EtablissementRepository $etablissementRepository;
    private PaginatorInterface $paginator;

    public function __construct(EtablissementRepository $etablissementRepository, PaginatorInterface $paginator)
    {
        $this->etablissementRepository = $etablissementRepository;
        $this->paginator = $paginator;
    }

    /**
     * Liste de tous les établissements(paginée)
     */
     
    #[Route('/', name: 'app_etablissement_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $query = $this->etablissementRepository->findAllQuery()->getQuery();
        return $this->paginateAndRender($request, $query, 'Tous les établissements');
    }

    /**
     * Afficher les détails d'un établissement
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
    public function listByDepartement(Request $request, string $codeDepartement): Response
    {
        $query = $this->etablissementRepository->findByDepartementQuery($codeDepartement)->getQuery();
        return $this->paginateAndRender($request, $query, "Établissements du département $codeDepartement");
    }

    /**
     * Liste des établissements par région
     */
    #[Route('/region/{codeRegion}', name: 'app_etablissement_by_region', methods: ['GET'])]
    public function listByRegion(Request $request, string $codeRegion): Response
    {
        $query = $this->etablissementRepository->findByRegionQuery($codeRegion)->getQuery();
        return $this->paginateAndRender($request, $query, "Établissements de la région $codeRegion");
    }

    /**
     * Liste des établissements par commune
     */
    #[Route('/commune/{codeCommune}', name: 'app_etablissement_by_commune', methods: ['GET'])]
    public function listByCommune(Request $request, string $codeCommune): Response
    {
        $query = $this->etablissementRepository->findByCommuneQuery($codeCommune)->getQuery();
        return $this->paginateAndRender($request, $query, "Établissements de la commune $codeCommune");
    }

    /**
     * Liste des établissements par académie
     */
    #[Route('/academie/{codeAcademie}', name: 'app_etablissement_by_academie', methods: ['GET'])]
    public function listByAcademie(Request $request, string $codeAcademie): Response
    {
        $query = $this->etablissementRepository->findByAcademieQuery($codeAcademie)->getQuery();
        return $this->paginateAndRender($request, $query, "Établissements de l'académie $codeAcademie");
    }

    /**
     * Liste des établissements par secteur (Public/Privé)
     */
    #[Route('/secteur/{secteur}', name: 'app_etablissement_by_secteur', methods: ['GET'])]
    public function listBySecteur(Request $request, string $secteur): Response
    {
        $query = $this->etablissementRepository->findBySecteurQuery($secteur)->getQuery();
        return $this->paginateAndRender($request, $query, "Établissements du secteur $secteur");
    }

    /**
     * Liste des établissements par type
     */
    #[Route('/type/{type}', name: 'app_etablissement_by_type', methods: ['GET'])]
    public function listByType(Request $request, string $type): Response
    {
        $query = $this->etablissementRepository->findByTypeQuery($type)->getQuery();
        return $this->paginateAndRender($request, $query, "Établissements de type $type");
    }

    /**
     * Fonction générique pour la pagination et l'affichage des établissements
     */
    private function paginateAndRender(Request $request, $query, string $title): Response
    {
        $etablissements = $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            40
        );

        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissements,
            'title' => $title
        ]);
    }
}

