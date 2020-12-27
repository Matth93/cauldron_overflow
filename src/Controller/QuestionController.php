<?php


namespace App\Controller;


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
    public function show($vraag, MarkdownParserInterface $markdownParser, CacheInterface $cache)
    {
        $antwoorden = [
          '`kijuhygtf`',
          'jhgfdxcfh',
          'jihugyfdszdxcfgvh',
        ];
        $content = "To do...." . $vraag;
        $questionText = "I've been turned into a crat, any thoughts on how to turn back? While I'm **adorable**, I don't really care for cat food.";

        $parsedQuestionText = $cache->get('markdown_'.md5($questionText), function() use ($questionText, $markdownParser) {
            return $markdownParser->transformMarkdown($questionText);
        });

        dump($cache);

        return $this->render('question/show.html.twig', [
            'answers' => $antwoorden,
            'questionText' => $parsedQuestionText,
            'text' => $content,
        ]);

    }
}