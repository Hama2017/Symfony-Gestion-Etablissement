<?php

namespace App\Repository;

use App\Entity\Etablissement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Etablissement>
 */
class EtablissementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etablissement::class);
    }

    /**
     * Retourne une QueryBuilder paginée pour tous les établissements
     */
    public function findAllQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.id', 'ASC');
    }

    /**
     * Retourne une QueryBuilder paginée pour les établissements par département
     */
    public function findByDepartementQuery(string $codeDepartement): QueryBuilder
    {
        return $this->createQueryBuilder('e')
            ->where('e.codeDepartement = :code')
            ->setParameter('code', $codeDepartement)
            ->orderBy('e.appellationOfficielle', 'ASC');
    }

    /**
     * Retourne une QueryBuilder paginée pour les établissements par région
     */
    public function findByRegionQuery(string $codeRegion): QueryBuilder
    {
        return $this->createQueryBuilder('e')
            ->where('e.codeRegion = :code')
            ->setParameter('code', $codeRegion)
            ->orderBy('e.appellationOfficielle', 'ASC');
    }

    /**
     * Retourne une QueryBuilder paginée pour les établissements par commune
     */
    public function findByCommuneQuery(string $codeCommune): QueryBuilder
    {
        return $this->createQueryBuilder('e')
            ->where('e.codeCommune = :code')
            ->setParameter('code', $codeCommune)
            ->orderBy('e.appellationOfficielle', 'ASC');
    }

    /**
     * Retourne une QueryBuilder paginée pour les établissements par académie
     */
    public function findByAcademieQuery(string $codeAcademie): QueryBuilder
    {
        return $this->createQueryBuilder('e')
            ->where('e.codeAcademie = :code')
            ->setParameter('code', $codeAcademie)
            ->orderBy('e.appellationOfficielle', 'ASC');
    }

    /**
     * Retourne une QueryBuilder paginée pour les établissements par secteur (Public/Privé)
     */
    public function findBySecteurQuery(string $secteur): QueryBuilder
    {
        return $this->createQueryBuilder('e')
            ->where('LOWER(TRIM(e.secteur)) LIKE LOWER(TRIM(:secteur))')
            ->setParameter('secteur', '%' . strtolower(trim($secteur)) . '%')
            ->orderBy('e.appellationOfficielle', 'ASC');
    }

    /**
     * Retourne une QueryBuilder paginée pour les établissements par type
     */
    public function findByTypeQuery(string $type): QueryBuilder
    {
        return $this->createQueryBuilder('e')
            ->where('LOWER(TRIM(e.denominationPrincipale)) LIKE LOWER(TRIM(:type))')
            ->setParameter('type', '%' . strtolower(trim($type)) . '%')
            ->orderBy('e.appellationOfficielle', 'ASC');
    }
}

