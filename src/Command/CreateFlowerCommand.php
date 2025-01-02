<?php

namespace App\Command;

use App\Entity\Flowers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


class CreateFlowerCommand extends Command
{
    protected static $defaultName = 'app:create-flower';
    protected static $defaultDescription = 'Create four flowers';

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
            ->setName('app:create-flower');
            
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $flower = [
            ['name' => 'première', 'price' => 20,'description'=>'fleur 1','image'=>'fleur.jpeg'],
             ['name' => 'deuxième', 'price' => 20,'description'=>'fleur 2','image'=>'fleur.jpeg'],
              ['name' => 'troisième', 'price' => 20,'description'=>'fleur 3','image'=>'fleur.jpeg'],
               ['name' => 'quatrième', 'price' => 20,'description'=>'fleur 4','image'=>'fleur.jpeg'],
        ];
   

        foreach ($flower as $flowerData) {
            $flower = new Flowers();
            $flower->setName($flowerData['name']);           
            $flower->setPrice($flowerData['price']);
            $flower->setDescription($flowerData['description']);
            $flower->setImage($flowerData['image']);
            $this->entityManager->persist($flower);
        }

        $this->entityManager->flush();

        $io->success('four flower have been created successfully.');

        return Command::SUCCESS;
    }
}