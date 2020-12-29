<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $question = new Question();
        $question->setName('Test')
            ->setSlug('test-'.rand(0,100))
            ->setQuestion('Wave impatiently like a proud plank. Tunas whine with fortune! Grace is a cloudy cannon. All ships haul scurvy, shiny golds. The tuna blows with adventure, fire the bikini atoll before it travels!');

        if (rand(1,10) > 2) {
            $question->setAskedAt(new \DateTime(sprintf('-%d days', rand(1,100))));
        }

        $question->setVotes(rand(-200, 5));

        $manager->persist($question);

        $manager->flush();

    }
}
