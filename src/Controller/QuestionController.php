<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController
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

        return new Response($content);
    }
}