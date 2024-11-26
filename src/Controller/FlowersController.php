<?php

namespace App\Controller;

use App\Entity\Flowers;
use App\Form\FlowersType;
use App\Repository\FlowersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class FlowersController extends AbstractController
{
    #[Route('/flowers', name: 'app_flowers')]
    public function index(FlowersRepository $flowersRepository): Response
    {
        $flowers = $flowersRepository -> findAllFlowers();

        return $this->render('flowers/index.html.twig', [
            'flowers' => $flowers,
        ]);
    }

    #[Route('/createFlowers', name: 'flowers_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $flower = new Flowers();
        $form = $this->createForm(FlowersType::class, $flower);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($flower);
            $entityManager->flush();

            return $this->redirectToRoute('app_flowers');
        }
        return $this->render('flowers/create.html.twig', [          
               'createForm' => $form->createView(),
        ]);
    }
    

    #[Route('/flowers/{id}', name: 'flowers_show')]
    public function show(int $id, FlowersRepository $flowersRepository): Response
    {
        $flower = $flowersRepository->findById($id);

        if (!$flower) {
            throw $this->createNotFoundException('The flower does not exist');
        }

        return $this->render('flowers/show.html.twig', [
            'flower' => $flower,
        ]);
    }

    
   #[Route('/updateFlowers/{id}', name: 'flowers_update')]
    public function update(int $id, Request $request, FlowersRepository $flowersRepository, EntityManagerInterface $entityManager): Response
    {
        $flower = $flowersRepository->find($id);

        if (!$flower) {
            throw $this->createNotFoundException('The flower does not exist');
        }

        $form = $this->createForm(FlowersType::class, $flower);

        $form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_flowers');
        }

        return $this->render('flowers/update.html.twig', [
            'updateForm' => $form->createView(),
        ]);
    }

    #[Route('/flowers/delete/{id}', name: 'flowers_delete', methods: ['POST'])]
    public function delete(int $id, FlowersRepository $flowersRepository): Response
    {
        $flower = $flowersRepository->find($id);

        if (!$flower) {
            throw $this->createNotFoundException('The flower does not exist');
        }

        $flowersRepository->deleteFlower($flower);

        return new Response('Flower deleted successfully');
    }
}