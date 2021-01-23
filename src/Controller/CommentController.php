<?php


namespace App\Controller;


use App\Form\CommentFormType;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comments/{id<\d+>}/vote/{direction<up|down>}", methods={"POST"})
     */
    public function commentVote($id, $direction, LoggerInterface $logger)
    {
        if ($direction === 'up') {
            $logger->info('Voting up!');
            $currentVoteCount = rand(7, 10000);
        } else {
            $logger->info('Voting down!');
            $currentVoteCount= rand(0, 5);
        }

        return $this->json(['votes' => $currentVoteCount]);

    }

    /**
     * @Route("/comment/new", name="comment_new")
     */
    public function new(EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(CommentFormType::class);

        return $this->render('comment/new.html.twig', [
           'commentForm' => $form->createView()
        ]);
    }
}