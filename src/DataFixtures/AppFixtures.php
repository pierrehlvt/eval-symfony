<?php

namespace App\DataFixtures;

use App\Entity\Acteur;
use App\Entity\Categorie;
use App\Entity\Film;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $statham = new Acteur();
        $statham->setName("Statham");
        $statham->setSurname("Jason");
        $manager->persist($statham);

        $depp = new Acteur();
        $depp->setName("Depp");
        $depp->setSurname("Johnny");
        $manager->persist($depp);

        $funes = new Acteur();
        $funes->setName("de Funès");
        $funes->setSurname("Louis");
        $manager->persist($funes);

        $dwayne = new Acteur();
        $dwayne->setName("Johnson");
        $dwayne->setSurname("Dwayne");
        $manager->persist($dwayne);
        
        $action = new Categorie();
        $action->setName("Action");
        $manager->persist($action);

        $thriller = new Categorie();
        $thriller->setName("Thriller");
        $manager->persist($thriller);

        $horreur = new Categorie();
        $horreur->setName("Horreur");
        $manager->persist($horreur);
        
        $fastandfurious = new Film();
        $fastandfurious->setName("Fast and Furious");
        $fastandfurious->setCategorie($action);
        $fastandfurious->addActeur($dwayne);
        $fastandfurious->addActeur($statham);
        $manager->persist($fastandfurious);
        
        $soupeauxchoux = new Film();
        $soupeauxchoux->setName("La soupe aux choux");
        $soupeauxchoux->setCategorie($thriller);
        $soupeauxchoux->addActeur($funes);
        $manager->persist($soupeauxchoux);
        
        $pirates = new Film();
        $pirates->setName("Pirates de Caraïbes");
        $pirates->setCategorie($horreur);
        $pirates->addActeur($depp);
        $manager->persist($pirates);
        
        $transporteur = new Film();
        $transporteur->setName("Le transporteur");
        $transporteur->setCategorie($action);
        $transporteur->addActeur($statham);
        $manager->persist($transporteur);
        
        $malibu = new Film();
        $malibu->setName("Baywatch, Alerte à Malibu");
        $malibu->setCategorie($action);
        $malibu->addActeur($dwayne);
        $manager->persist($malibu);

        $manager->flush();
    }
}
