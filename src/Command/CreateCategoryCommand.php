<?php

namespace App\Command;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


class CreateCategoryCommand extends Command
{
    protected static $defaultName = 'app:create-category';
    protected static $defaultDescription = 'Create six categories';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->setName('app:create-category');
            
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $category = [
            ['name' => 'Fleurs', 'price' => 20,'description'=>'fleur 1','image'=>'fleur-1.jpeg'],
             ['name' => 'Plantes','description'=>'fleur 4','image'=>'fleur-4.jpg'],
              ['name' => 'Bouquets','description'=>'fleur 5','image'=>'fleur-5.jpg'],    
        ];
   

        foreach ($category as $categoryData) {
            $category = new Category();
            $category->setName($categoryData['name']);           
            $category->setDescription($categoryData['description']);
            $category->setImage($categoryData['image']);
            $this->entityManager->persist($category);
        }

        $this->entityManager->flush();

        $io->success('three category have been created successfully.');

        return Command::SUCCESS;
    }
}