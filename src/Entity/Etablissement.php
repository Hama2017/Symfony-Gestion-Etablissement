<?php

namespace App\Entity;

use App\Repository\EtablissementRepository;
use App\Enum\Secteur;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EtablissementRepository::class)]
class Etablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20, unique: true)]
    #[Assert\NotBlank(message: "Le numéro UAI est obligatoire")]
    private ?string $numeroUai = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $appellationOfficielle = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $denominationPrincipale = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $patronyme = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(message: "Le secteur est obligatoire")]
    #[Assert\Choice(choices: ["Public", "Privé"], message: "Le secteur doit être 'Public' ou 'Privé'")]
    private ?string $secteur = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $codePostal = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $commune = null;

    #[ORM\Column(nullable: true)]
    private ?float $latitude = null;

    #[ORM\Column(nullable: true)]
    private ?float $longitude = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $natureUaiLibelle = null;

    #[ORM\Column(nullable: true)]
    private ?int $natureUaiCode = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "L'état de l'établissement est obligatoire")]
    private ?string $etatEtablissement = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $codeDepartement = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $departement = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $codeRegion = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $region = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $codeAcademie = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $academie = null;

    #[ORM\Column(type: "date", nullable: true)]
    private ?\DateTimeInterface $dateOuverture = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $sigle = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $codeCommune = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $codeMinistere = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $ministere = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroUai(): ?string
    {
        return $this->numeroUai;
    }

    public function setNumeroUai(string $numeroUai): static
    {
        $this->numeroUai = $numeroUai;

        return $this;
    }

    public function getAppellationOfficielle(): ?string
    {
        return $this->appellationOfficielle;
    }

    public function setAppellationOfficielle(?string $appellationOfficielle): static
    {
        $this->appellationOfficielle = $appellationOfficielle;

        return $this;
    }

    public function getDenominationPrincipale(): ?string
    {
        return $this->denominationPrincipale;
    }

    public function setDenominationPrincipale(?string $denominationPrincipale): static
    {
        $this->denominationPrincipale = $denominationPrincipale;

        return $this;
    }

    public function getPatronyme(): ?string
    {
        return $this->patronyme;
    }

    public function setPatronyme(?string $patronyme): static
    {
        $this->patronyme = $patronyme;

        return $this;
    }

    public function getSecteur(): ?string
    {
        return $this->secteur;
    }

    public function setSecteur(string $secteur): static
    {
        $this->secteur = $secteur;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

public function getCodePostal(): ?string
{
    return $this->codePostal;
}

public function setCodePostal(?string $codePostal): static
{
    $this->codePostal = $codePostal;
    
    return $this;
}

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(?string $commune): static
    {
        $this->commune = $commune;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getNatureUaiLibelle(): ?string
    {
        return $this->natureUaiLibelle;
    }

    public function setNatureUaiLibelle(?string $natureUaiLibelle): static
    {
        $this->natureUaiLibelle = $natureUaiLibelle;

        return $this;
    }

    public function getNatureUaiCode(): ?int
    {
        return $this->natureUaiCode;
    }

    public function setNatureUaiCode(?int $natureUaiCode): static
    {
        $this->natureUaiCode = $natureUaiCode;

        return $this;
    }

    public function getEtatEtablissement(): ?string
    {
        return $this->etatEtablissement;
    }

    public function setEtatEtablissement(string $etatEtablissement): static
    {
        $this->etatEtablissement = $etatEtablissement;

        return $this;
    }

    public function getCodeDepartement(): ?string
    {
        return $this->codeDepartement;
    }

    public function setCodeDepartement(?string $codeDepartement): static
    {
        $this->codeDepartement = $codeDepartement;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(?string $departement): static
    {
        $this->departement = $departement;

        return $this;
    }

    public function getCodeRegion(): ?string
    {
        return $this->codeRegion;
    }

    public function setCodeRegion(?string $codeRegion): static
    {
        $this->codeRegion = $codeRegion;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): static
    {
        $this->region = $region;

        return $this;
    }

    public function getCodeAcademie(): ?string
    {
        return $this->codeAcademie;
    }

    public function setCodeAcademie(?string $codeAcademie): static
    {
        $this->codeAcademie = $codeAcademie;

        return $this;
    }

    public function getAcademie(): ?string
    {
        return $this->academie;
    }

    public function setAcademie(?string $academie): static
    {
        $this->academie = $academie;

        return $this;
    }

    public function getDateOuverture(): ?\DateTimeInterface
    {
        return $this->dateOuverture;
    }

    public function setDateOuverture(?\DateTimeInterface $dateOuverture): static
    {
        $this->dateOuverture = $dateOuverture;

        return $this;
    }

    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    public function setSigle(?string $sigle): static
    {
        $this->sigle = $sigle;

        return $this;
    }

    public function getCodeCommune(): ?string
    {
        return $this->codeCommune;
    }

    public function setCodeCommune(?string $codeCommune): static
    {
        $this->codeCommune = $codeCommune;

        return $this;
    }

    public function getCodeMinistere(): ?string
    {
        return $this->codeMinistere;
    }

    public function setCodeMinistere(?string $codeMinistere): static
    {
        $this->codeMinistere = $codeMinistere;

        return $this;
    }

    public function getMinistere(): ?string
    {
        return $this->ministere;
    }

    public function setMinistere(?string $ministere): static
    {
        $this->ministere = $ministere;

        return $this;
    }
}