// src/Controller/EtablissementController.php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Repository\EtablissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EtablissementController extends AbstractController
{
    #[Route('/etablissements', name: 'etablissements_index')]
    public function index(EtablissementRepository $repository): Response
    {
        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $repository->findAll(),
            'total' => $repository->count([])
        ]);
    }

    #[Route('/etablissements/departement/{code}', name: 'etablissements_departement')]
    public function byDepartement(string $code, EtablissementRepository $repository): Response
    {
        return $this->render('etablissement/list.html.twig', [
            'etablissements' => $repository->findBy(['codeDepartement' => $code]),
            'filtre' => 'Département '.$code,
            'colonnes' => $this->getColonnesDepartement()
        ]);
    }

    #[Route('/etablissements/academie/{code}', name: 'etablissements_academie')]
    public function byAcademie(string $code, EtablissementRepository $repository): Response
    {
        return $this->render('etablissement/list.html.twig', [
            'etablissements' => $repository->findBy(['codeAcademie' => $code]),
            'filtre' => 'Académie '.$code,
            'colonnes' => $this->getColonnesAcademie()
        ]);
    }

    #[Route('/etablissement/{numeroUai}', name: 'etablissement_show')]
    public function show(Etablissement $etablissement): Response
    {
        return $this->render('etablissement/show.html.twig', [
            'etablissement' => $etablissement,
            'details' => $this->getDetailsStructure()
        ]);
    }

    private function getColonnesDepartement(): array
    {
        return [
            'numero_uai' => 'Numéro UAI',
            'appellation_officielle' => 'Nom officiel',
            'denomination_principale' => 'Type',
            'code_postal_uai' => 'Code postal',
            'libelle_commune' => 'Commune',
            'secteur_public_prive_libe' => 'Secteur'
        ];
    }

    private function getColonnesAcademie(): array
    {
        return [
            'numero_uai' => 'Numéro UAI',
            'libelle_departement' => 'Département',
            'libelle_commune' => 'Commune',
            'nature_uai_libe' => 'Nature',
            'date_ouverture' => 'Date ouverture'
        ];
    }

    private function getDetailsStructure(): array
    {
        return [
            'Coordonnées' => [
                'adresse_uai',
                'code_postal_uai',
                'localite_acheminement_uai',
                'latitude',
                'longitude'
            ],
            'Administratif' => [
                'code_departement',
                'code_region',
                'code_academie',
                'etat_etablissement_libe'
            ],
            'Caractéristiques' => [
                'nature_uai_libe',
                'secteur_prive_libelle_type_contrat',
                'libelle_ministere'
            ]
        ];
    }
}
