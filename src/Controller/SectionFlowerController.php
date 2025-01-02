<?php

namespace App\Controller;

use App\Entity\Flowers;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SectionFlowerController extends AbstractController
{
    #[Route('/section/flower', name: 'app_section_flower')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $flowers=$entityManager->getRepository(Flowers::class)->findSample();

        return $this->render('section_flower/index.html.twig', [
            'flowers' => $flowers,
        ]);
    }
}