<?php


namespace App\Controller;


use App\Entity\Comment;
use App\Form\CommentFormType;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function new(EntityManagerInterface $entityManager,Request $request, QuestionRepository $questionRepository)
    {
        $form = $this->createForm(CommentFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $comment = new Comment();
            $comment->setAuthorName($data['authorName']);
            $comment->setContent($data['content']);
            $comment->setIsDeleted(false);

            $questions = $questionRepository->findAll();
            shuffle($questions);
            $randomQuestion = $questions[0];
            $comment->setQuestion($randomQuestion);

            $entityManager->persist($comment);
            $entityManager->flush();

            $this->addFlash('success', 'lekker bezig');

            return $this->redirectToRoute('comment_admin');
        }

        return $this->render('comment/new.html.twig', [
           'commentForm' => $form->createView()
        ]);
    }
}