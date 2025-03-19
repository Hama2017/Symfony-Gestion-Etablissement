<?php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Repository\EtablissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/etablissements')]
class EtablissementController extends AbstractController
{
    private $etablissementRepository;
    private $paginator;

    public function __construct(EtablissementRepository $etablissementRepository, PaginatorInterface $paginator)
    {
        $this->etablissementRepository = $etablissementRepository;
        $this->paginator = $paginator;
    }

    /**
     * Liste de tous les établissements (paginée)
     */
    #[Route('/', name: 'app_etablissement_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $query = $this->etablissementRepository->createQueryBuilder('e')
            ->orderBy('e.id', 'ASC')
            ->getQuery();

        $etablissements = $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            40 // Nombre d'éléments par page
        );

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
     * Liste des établissements par département (paginée)
     */
    #[Route('/departement/{codeDepartement}', name: 'app_etablissement_by_departement', methods: ['GET'])]
    public function listByDepartement(Request $request, string $codeDepartement): Response
    {
        $query = $this->etablissementRepository->createQueryBuilder('e')
            ->where('e.codeDepartement = :code')
            ->setParameter('code', $codeDepartement)
            ->orderBy('e.appellationOfficielle', 'ASC')
            ->getQuery();
        
        $etablissements = $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            40
        );
        
        // Récupérer le nom du département
        $departementName = $codeDepartement;
        $firstEtablissement = $this->etablissementRepository->findOneBy(['codeDepartement' => $codeDepartement]);
        if ($firstEtablissement) {
            $departementName = $firstEtablissement->getDepartement();
        }

        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissements,
            'title' => 'Établissements du département ' . $departementName
        ]);
    }

    /**
     * Liste des établissements par région (paginée)
     */
    #[Route('/region/{codeRegion}', name: 'app_etablissement_by_region', methods: ['GET'])]
    public function listByRegion(Request $request, string $codeRegion): Response
    {
        $query = $this->etablissementRepository->createQueryBuilder('e')
            ->where('e.codeRegion = :code')
            ->setParameter('code', $codeRegion)
            ->orderBy('e.appellationOfficielle', 'ASC')
            ->getQuery();
        
        $etablissements = $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            40
        );
        
        // Récupérer le nom de la région
        $regionName = $codeRegion;
        $firstEtablissement = $this->etablissementRepository->findOneBy(['codeRegion' => $codeRegion]);
        if ($firstEtablissement) {
            $regionName = $firstEtablissement->getRegion();
        }

        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissements,
            'title' => 'Établissements de la région ' . $regionName
        ]);
    }

    /**
     * Liste des établissements par commune (paginée)
     */
    #[Route('/commune/{codeCommune}', name: 'app_etablissement_by_commune', methods: ['GET'])]
    public function listByCommune(Request $request, string $codeCommune): Response
    {
        $query = $this->etablissementRepository->createQueryBuilder('e')
            ->where('e.codeCommune = :code')
            ->setParameter('code', $codeCommune)
            ->orderBy('e.appellationOfficielle', 'ASC')
            ->getQuery();
        
        $etablissements = $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            40
        );
        
        // Récupérer le nom de la commune
        $communeName = $codeCommune;
        $firstEtablissement = $this->etablissementRepository->findOneBy(['codeCommune' => $codeCommune]);
        if ($firstEtablissement) {
            $communeName = $firstEtablissement->getCommune();
        }

        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissements,
            'title' => 'Établissements de la commune de ' . $communeName
        ]);
    }

    /**
     * Liste des établissements par académie (paginée)
     */
    #[Route('/academie/{codeAcademie}', name: 'app_etablissement_by_academie', methods: ['GET'])]
    public function listByAcademie(Request $request, string $codeAcademie): Response
    {
        $query = $this->etablissementRepository->createQueryBuilder('e')
            ->where('e.codeAcademie = :code')
            ->setParameter('code', $codeAcademie)
            ->orderBy('e.appellationOfficielle', 'ASC')
            ->getQuery();
        
        $etablissements = $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            40
        );
        
        // Récupérer le nom de l'académie
        $academieName = $codeAcademie;
        $firstEtablissement = $this->etablissementRepository->findOneBy(['codeAcademie' => $codeAcademie]);
        if ($firstEtablissement) {
            $academieName = $firstEtablissement->getAcademie();
        }

        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissements,
            'title' => 'Établissements de l\'académie de ' . $academieName
        ]);
    }

    /**
     * Liste des établissements par secteur (paginée)
     */
    #[Route('/secteur/{secteur}', name: 'app_etablissement_by_secteur', methods: ['GET'])]
    public function listBySecteur(Request $request, string $secteur): Response
    {
        $query = $this->etablissementRepository->createQueryBuilder('e')
            ->where('e.secteur = :secteur')
            ->setParameter('secteur', $secteur)
            ->orderBy('e.appellationOfficielle', 'ASC')
            ->getQuery();
        
        $etablissements = $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            40
        );

        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissements,
            'title' => 'Établissements du secteur ' . $secteur
        ]);
    }

    /**
     * Liste des établissements par type (paginée)
     */
    #[Route('/type/{type}', name: 'app_etablissement_by_type', methods: ['GET'])]
    public function listByType(Request $request, string $type): Response
    {
        $query = $this->etablissementRepository->createQueryBuilder('e')
            ->where('e.denominationPrincipale = :type')
            ->setParameter('type', $type)
            ->orderBy('e.appellationOfficielle', 'ASC')
            ->getQuery();
        
        $etablissements = $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            40
        );

        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissements,
            'title' => 'Établissements de type ' . $type
        ]);
    }
}
