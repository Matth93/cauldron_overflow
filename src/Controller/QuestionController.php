<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function show($vraag)
    {
        $content = "To do...." . $vraag;
        $antwoorden = [
          'kijuhygtf',
          'jhgfdxcfh',
          'jihugyfdszdxcfgvh',
        ];

        return $this->render('question/show.html.twig', [
           'text' => $content,
           'answers' => $antwoorden,
        ]);

    }
}