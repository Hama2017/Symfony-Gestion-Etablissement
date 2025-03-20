<?php
namespace App\DataFixtures;

use App\Entity\Etablissement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EtablissementFixtures extends Fixture {
    // fichier CSV des etablissements
    private const CSV_FILE = __DIR__ . '/Resources/fr-en-adresse-et-geolocalisation-etablissements-premier-et-second-degre.csv';
    // taille des lots pour optimiser la memoire
    private const BATCH_SIZE = 500;
    
    private function getCsvData(): \Generator
    {
        $handle = fopen(self::CSV_FILE, 'r');
        
        if (!$handle) {
            throw new \Exception("Impossible d'ouvrir le fichier CSV");
        }
        
        // on saute l'entete
        fgetcsv($handle, 0, ';');
        
        while (($data = fgetcsv($handle, 0, ';')) !== false) {
            yield $data;
        }
        
        fclose($handle);
    }
    
    public function load(ObjectManager $manager): void
    {
        // desactive le SQL logger pour les performances
        $manager->getConnection()->getConfiguration()->setSQLLogger(null);
        
        if (!file_exists(self::CSV_FILE)) {
            throw new \Exception("Le fichier CSV n'existe pas: " . self::CSV_FILE);
        }
        
        $iteration = 0;
        
        foreach ($this->getCsvData() as $data) {
            
            $etablissement = new Etablissement();
            
            $etablissement->setNumeroUai($data[0] ?? '');
            $etablissement->setAppellationOfficielle($data[1] ?? null);
            $etablissement->setDenominationPrincipale($data[2] ?? null);
            $etablissement->setPatronyme($data[3] ?? null);
            $etablissement->setSecteur($data[4] ?? 'Public');
            $etablissement->setAdresse($data[5] ?? null);
            $etablissement->setCodePostal(is_numeric($data[8] ?? null) ? (string)$data[8] : null);
            $etablissement->setCommune($data[10] ?? null);
            
            // coordonnees GPS
            $latitude = $data[14] ?? null;
            $longitude = $data[15] ?? null;
            $etablissement->setLatitude(is_numeric($latitude) ? (float)$latitude : null);
            $etablissement->setLongitude(is_numeric($longitude) ? (float)$longitude : null);
            
            $etablissement->setNatureUaiCode(is_numeric($data[18] ?? null) ? (int)$data[18] : null);
            $etablissement->setNatureUaiLibelle($data[19] ?? null);
            $etablissement->setEtatEtablissement($data[21] ?? 'OUVERT');
            
            $etablissement->setCodeDepartement((string)($data[22] ?? null));
            $etablissement->setDepartement($data[26] ?? null);
            $etablissement->setCodeRegion((string)($data[23] ?? null));
            $etablissement->setRegion($data[27] ?? null);
            $etablissement->setCodeAcademie((string)($data[24] ?? null));
            $etablissement->setAcademie($data[28] ?? null);
            $etablissement->setCodeCommune((string)($data[25] ?? null));
            
            $etablissement->setCodeMinistere((string)($data[32] ?? null));
            $etablissement->setMinistere($data[33] ?? null);
            
            $dateOuverture = $data[34] ?? null;
            if ($dateOuverture) {
                try {
                    $etablissement->setDateOuverture(new \DateTime($dateOuverture));
                } catch (\Exception $e) {
                    // silence en cas d'erreur
                }
            }
            
            $etablissement->setSigle($data[35] ?? null);
            
            $manager->persist($etablissement);
            
            $iteration++;
            
            // flush par lot pour gerer la memoire
            if ($iteration % self::BATCH_SIZE === 0) {
                $manager->flush();
                $manager->clear();
                gc_enable();
                gc_collect_cycles();
                echo "Importes: $iteration etablissements\n";
            }
        }
        
        if ($iteration % self::BATCH_SIZE !== 0) {
            $manager->flush();
        }
        
        echo "Importation terminee: $iteration etablissements importes\n";
    }
}