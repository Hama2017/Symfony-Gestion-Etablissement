<?php

namespace App\Entity;

use App\Repository\EtablissementRepository;
use App\Enum\Secteur;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtablissementRepository::class)]
class Etablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 10, unique: true)]
    private ?string $numeroUai = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $appellationOfficielle = null;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $denominationPrincipale = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $patronyme = null;

    #[ORM\Column(type: 'string', enumType: Secteur::class)]
    private ?Secteur $secteur = null;

    #[ORM\Column(type: 'float')]
    private ?float $longitude = null;

    #[ORM\Column(type: 'float')]
    private ?float $latitude = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private ?string $codePostal = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $localiteAcheminement = null;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private ?string $codeDepartement = null;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $departement = null;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private ?string $codeCommune = null;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $commune = null;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private ?string $codeRegion = null;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $region = null;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private ?string $codeAcademie = null;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $academie = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $nature = null;

    #[ORM\Column(type: 'boolean')]
    private bool $estOuvert = true;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $ministere = null;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private ?string $sigle = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $dateOuverture = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $typeContrat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroUai(): ?string
    {
        return $this->numeroUai;
    }

    public function setNumeroUai(string $numeroUai): self
    {
        $this->numeroUai = $numeroUai;

        return $this;
    }

    public function getAppellationOfficielle(): ?string
    {
        return $this->appellationOfficielle;
    }

    public function setAppellationOfficielle(string $appellationOfficielle): self
    {
        $this->appellationOfficielle = $appellationOfficielle;

        return $this;
    }

    public function getDenominationPrincipale(): ?string
    {
        return $this->denominationPrincipale;
    }

    public function setDenominationPrincipale(string $denominationPrincipale): self
    {
        $this->denominationPrincipale = $denominationPrincipale;

        return $this;
    }

    public function getPatronyme(): ?string
    {
        return $this->patronyme;
    }

    public function setPatronyme(?string $patronyme): self
    {
        $this->patronyme = $patronyme;

        return $this;
    }

    public function getSecteur(): ?Secteur
    {
        return $this->secteur;
    }

    public function setSecteur(Secteur $secteur): self
    {
        $this->secteur = $secteur;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(?string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getLocaliteAcheminement(): ?string
    {
        return $this->localiteAcheminement;
    }

    public function setLocaliteAcheminement(?string $localiteAcheminement): self
    {
        $this->localiteAcheminement = $localiteAcheminement;

        return $this;
    }

    public function getCodeDepartement(): ?string
    {
        return $this->codeDepartement;
    }

    public function setCodeDepartement(?string $codeDepartement): self
    {
        $this->codeDepartement = $codeDepartement;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getCodeCommune(): ?string
    {
        return $this->codeCommune;
    }

    public function setCodeCommune(?string $codeCommune): self
    {
        $this->codeCommune = $codeCommune;

        return $this;
    }

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(string $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    public function getCodeRegion(): ?string
    {
        return $this->codeRegion;
    }

    public function setCodeRegion(?string $codeRegion): self
    {
        $this->codeRegion = $codeRegion;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getCodeAcademie(): ?string
    {
        return $this->codeAcademie;
    }

    public function setCodeAcademie(?string $codeAcademie): self
    {
        $this->codeAcademie = $codeAcademie;

        return $this;
    }

    public function getAcademie(): ?string
    {
        return $this->academie;
    }

    public function setAcademie(string $academie): self
    {
        $this->academie = $academie;

        return $this;
    }

    public function getNature(): ?string
    {
        return $this->nature;
    }

    public function setNature(?string $nature): self
    {
        $this->nature = $nature;

        return $this;
    }

    public function isEstOuvert(): bool
    {
        return $this->estOuvert;
    }

    public function setEstOuvert(bool $estOuvert): self
    {
        $this->estOuvert = $estOuvert;

        return $this;
    }

    public function getMinistere(): ?string
    {
        return $this->ministere;
    }

    public function setMinistere(?string $ministere): self
    {
        $this->ministere = $ministere;

        return $this;
    }

    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    public function setSigle(?string $sigle): self
    {
        $this->sigle = $sigle;

        return $this;
    }

    public function getDateOuverture(): ?\DateTimeInterface
    {
        return $this->dateOuverture;
    }

    public function setDateOuverture(\DateTimeInterface $dateOuverture): self
    {
        $this->dateOuverture = $dateOuverture;

        return $this;
    }

    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(?string $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }
}