<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Project;
use App\Entity\Vico;
use DateTime;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $client = new Client();
            $client->setFirstName($this->faker->name);
            $client->setLastName($this->faker->name);
            $client->setCreated(new DateTime());
            $options = [
                'cost' => 12,
            ];
            $client->setPassword(password_hash('test', PASSWORD_BCRYPT, $options));
            $client->setUsername($this->faker->userName);
            $manager->persist($client);
            $manager->flush();

            $vico = new Vico();

            $vico->setCreated(new DateTime());
            $vico->setName($this->faker->name);

            $manager->persist($vico);
            $manager->flush();

            $project = new Project();

            $project->setCreated(new DateTime());
            $project->setCreator($client);
            $project->setTitle($this->faker->title);
            $project->setVico($vico);

            $manager->persist($project);
            $manager->flush();

        }
    }
}
