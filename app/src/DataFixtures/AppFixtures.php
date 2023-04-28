<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Feedback;
use App\Entity\Project;
use App\Entity\RatingQuestion;
use App\Entity\Ratings;
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
        for ($i = 0; $i < 5; $i++) {
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

            $ratingQuestion = new RatingQuestion();

            $ratingQuestion->setProject($project);
            $ratingQuestion->setQuestionText($this->faker->text);
            $ratingQuestion->setCreatedAt(new DateTime('now'));

            $manager->persist($ratingQuestion);
            $manager->flush();

            $feedback = new Feedback();
            $feedback->setComment($this->faker->text);
            $feedback->setProject($project);
            $feedback->setCreatedAt(new DateTime('now'));
            $feedback->setClient($client);
            $feedback->setOverallRating(4.5);

            $manager->persist($feedback);
            $manager->flush();

            $rating = new Ratings();

            $rating->setFeedback($feedback);
            $rating->setRatingQuestion($ratingQuestion);
            $rating->setScore(4.5);
            $rating->setCreatedAt(new DateTime('now'));

            $manager->persist($rating);
            $manager->flush();
        }
    }
}
