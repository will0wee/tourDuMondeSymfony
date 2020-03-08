<?php

namespace App\DataFixtures;

use App\Entity\Decouverte;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as Faker;

class DecouverteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker::create();

    	// création de plusieurs produits
        for($i = 0; $i < 50; $i++) {
            // instanciation d'une entité
                $decouverte = new Decouverte();
                $decouverte->setName($faker->sentence(3));
                $decouverte->setPays($faker->unique()->word);
                $decouverte->setArticle($faker->text(200));
                $randomImage = random_int(1, 4);
                $decouverte->setImage('img'.$randomImage);
                
                // récupération des références des continents
                $randomContinent = random_int(0, 4);
                $continent = $this->getReference("continent$randomContinent");

                // associer une catégorie au produit
                $decouverte->setContinent($continent);

                // doctrine : méthode persist permet de créer un enregistrement (INSERT INTO)
                $manager->persist($decouverte);
        }

        // doctrine : méthode flush permet d'exécuter les requêtes SQL (à exécuter une seule fois)
        $manager->flush();
    }
}
