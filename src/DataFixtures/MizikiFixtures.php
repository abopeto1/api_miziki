<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\Person;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MizikiFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $persons = [
            ["id" => 1, "name" => "Fally Ipupa", "gender" => Person::GENDER_MALE, ],
            ["id" => 2, "name" => "Dena Mwana", "gender" => Person::GENDER_FEMALE,]
        ];

        foreach($persons as $person){
            $newPerson = new Person();
            $newPerson
                ->setName($person["name"])
                ->setGender($person["gender"])
                ->setDateCreated(new DateTime())
            ;

            $artist = new Artist();
            $artist
                ->setDateCreated(new DateTime())
                ->setPerson($newPerson);
            $manager->persist($newPerson);
            $manager->persist($artist);
        }

        $manager->flush();
    }
}
