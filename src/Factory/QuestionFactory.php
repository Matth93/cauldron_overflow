<?php

namespace App\Factory;

use App\Entity\Comment;
use App\Entity\Question;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Question|Proxy findOrCreate(array $attributes)
 * @method static Question|Proxy random()
 * @method static Question[]|Proxy[] randomSet(int $number)
 * @method static Question[]|Proxy[] randomRange(int $min, int $max)
 * @method static QuestionRepository|RepositoryProxy repository()
 * @method Question|Proxy create($attributes = [])
 * @method Question[]|Proxy[] createMany(int $number, $attributes = [])
 */
final class QuestionFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

//         TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    public function unpublished(): self
    {
        return $this->addState(['askedAt' => null]);
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->realText(rand(30, 50)),
            'question' => self::faker()->paragraphs(rand(2,4), true),
            'askedAt' => self::faker()->dateTimeBetween('-100 days', 'now'),
            'votes' => rand(-200, 5),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
//             ->afterInstantiate(function(Question $question, EntityManagerInterface $entityManager) {
//
//             })
        ;
    }

    protected static function getClass(): string
    {
        return Question::class;
    }
}
