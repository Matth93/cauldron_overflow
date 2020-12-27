<?php


namespace App\Controller;


use App\Service\MarkdownHelper;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;

class QuestionController extends AbstractController
{
    /**
     * @Route("/rrr", name="krrrrra")
     */
    public function homepage()
    {
        return $this->render('homepage.html.twig');
    }

    /**
     * @Route("/vragen/{vraag}", name="brende")
     */
    public function show($vraag, MarkdownHelper $markdownHelper)
    {
        $antwoorden = [
          '`kijuhygtf`',
          'jhgfdxcfh',
          'jihugyfdszdxcfgvh',
        ];
        $content = "To do...." . $vraag;
        $questionText = "I've been turned into a crat, any thoughts on how to turn back? While I'm **adorable**, I don't really care for cat food.";

        $parsedQuestionText = $markdownHelper->parse($questionText);

        dump($this->getParameter('cache_adapter'));

        return $this->render('question/show.html.twig', [
            'answers' => $antwoorden,
            'questionText' => $parsedQuestionText,
            'text' => $content,
        ]);

    }
}