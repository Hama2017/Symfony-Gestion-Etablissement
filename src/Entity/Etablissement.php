<?php

namespace App\Entity;

use App\Repository\EtablissementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtablissementRepository::class)]
class Etablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $appellationOfficielle = null;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $denominationPrincipale = null;

    #[ORM\Column(type: 'string', enumType: Secteur::class)]
    private ?Secteur $secteur = null;

    #[ORM\Column(type: 'float')]
    private ?float $longitude = null;

    #[ORM\Column(type: 'float')]
    private ?float $latitude = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $departement = null;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $commune = null;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $region = null;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $academie = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $dateOuverture = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    
}
