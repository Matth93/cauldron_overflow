<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/rrr")
     */
    public function homepage()
    {
        return new Response('Hi there');
    }

    /**
     * @Route("/vragen/{vraag}")
     */
    public function show($vraag)
    {
        $content = "To do...." . $vraag;

        return $this->render('question/show.html.twig', [
           'text' => $content,
        ]);

    }
}