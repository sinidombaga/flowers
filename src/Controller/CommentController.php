<?php

namespace App\Controller;

use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Comment;
use App\Repository\CommentRepository;
use App\Repository\FlowersRepository;

class CommentController extends AbstractController
{
    #[Route('/comment/new', name: 'comment_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $commentaire = new Comment();
        $form = $this->createForm(CommentType::class, $commentaire);

        // Set the user field programmatically
        $form->get('user')->setData($this->getUser());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire=$form->getData();
            $commentaire->setUser($this->getUser());
            $commentaire->setCreatedAt(new \DateTimeImmutable());
            $commentaire->setVerified('non');
            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('comment_success');
        }else{
            return $this->render('comment/new.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }

    public function commentList(CommentRepository $commentRepository, FlowersRepository $flowersRepository): Response
    {

        return $this->render('comment/customers.html.twig', [
            'commentaires' => $commentRepository->findByVerified(),
            'flowers' => $flowersRepository->findAll()
        ]);
      
        }

}