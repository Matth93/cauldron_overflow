<?php


namespace App\Controller;


use App\Entity\Question;
use App\Repository\QuestionRepository;
use App\Service\MarkdownHelper;
use ContainerAUJRyuH\getConsole_ErrorListenerService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;

class QuestionController extends AbstractController
{
    /**
     * @Route("/rrr", name="krrrrra")
     */
    public function homepage(QuestionRepository $repository)
    {
        $questions = $repository->findAllAskedOrderedByNewest();

        return $this->render('homepage.html.twig', ['questions' => $questions]);
    }

    /**
     * @Route("/vragen/new")
     */
    public function new(EntityManagerInterface $entityManager)
    {
        $question = new Question();
        $question->setName('Test')
            ->setSlug('test-'.rand(0,100))
            ->setQuestion('Wave impatiently like a proud plank. Tunas whine with fortune! Grace is a cloudy cannon. All ships haul scurvy, shiny golds. The tuna blows with adventure, fire the bikini atoll before it travels!');

        if (rand(1,10) > 2) {
            $question->setAskedAt(new \DateTime(sprintf('-%d days', rand(1,100))));
        }

        $question->setVotes(rand(-200, 5));

        $entityManager->persist($question);
        $entityManager->flush();

        return new Response(sprintf('Nieuwe vraag aangemaakt, met id #%d, slug %s',
            $question->getId(),
            $question->getSlug()
        ));
    }

    /**
     * @Route("/vragen/{vraag}", name="brende")
     */
    public function show($vraag, MarkdownHelper $markdownHelper, QuestionRepository $repository)
    {
        $question = $repository->findOneBy(['slug' => $vraag]);
        if (!$question)
        {
            throw $this->createNotFoundException('Vraag niet gevonden');
        }

        $antwoorden = [
          '`kijuhygtf`',
          'jhgfd**`xcfh`**',
          'jihugyfdszdxcfgvh',
        ];

        return $this->render('question/show.html.twig', [
            'answers' => $antwoorden,
            'question' => $question,
        ]);

    }

    /**
     * @Route("/questions/{slug}/vote", name="app_question_vote", methods="POST")
     */
    public function questionVote(Question $question, Request $request, EntityManagerInterface $entityManager)
    {
        $direction = $request->request->get('direction');

        if ($direction === 'up') {
            $question->upVote();
        } elseif ($direction === 'down'){
            $question->downVote();
        }

        $entityManager->flush();

        return $this->redirectToRoute('brende', [
            'vraag' => $question->getSlug()
        ]);
    }
}