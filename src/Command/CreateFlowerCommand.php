<?php

namespace App\Command;

use App\Entity\Category;
use App\Entity\Flowers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateFlowerCommand extends Command
{
    protected static $defaultName = 'app:create-flower';
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setName('app:create-flower')
            ->setDescription('Creates new flowers.')
            ->setHelp('This command allows you to create flowers...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Example flower data
        $flower = [
            ['name' => 'Rose ', 'price' => 20,'description'=>'fleur 1','image'=>'fleur-18.jpg', 'category_id'=>1],
             ['name' => 'Petale', 'price' => 20,'description'=>'fleur 4','image'=>'fleur-19.jpg', 'category_id'=>1],
                ['name' => 'Croix', 'price' => 20,'description'=>'fleur 5','image'=>'fleur-17.jpg' , 'category_id'=>1],
                    ['name' => 'Croix', 'price' => 20,'description'=>'Rose fatale','image'=>'fleur-10.jpg' , 'category_id'=>1],
        
        ];

        foreach ($flower as $flowerData) {
            $category = $this->entityManager->getRepository(Category::class)->find($flowerData['category_id']);
            
            if (!$category) {
                throw new \Exception('Category not found for ID ' . $flowerData['category_id']);
            }

            $flower = new Flowers();
            $flower->setName($flowerData['name']);           
            $flower->setPrice($flowerData['price']);
            $flower->setDescription($flowerData['description']);
            $flower->setImage($flowerData['image']);
            $flower->setCategory($category);
            $this->entityManager->persist($flower);
        }

        $this->entityManager->flush();

        $io->success('Flowers have been created successfully.');

        return Command::SUCCESS;
    }
}