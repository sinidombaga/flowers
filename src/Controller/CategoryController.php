<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{

    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('component/sectionCategory.html.twig', [
            'categories' => $categoryRepository-> findAll()
        ]);
    }
}