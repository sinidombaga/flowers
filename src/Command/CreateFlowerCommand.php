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
    protected static $defaultDescription = 'Create six flowers';

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
            ['name' => 'Nos fleurs de France', 'price' => 20,'description'=>'fleur 1','image'=>'fleur-1.jpeg'],
             ['name' => 'Nos Coffrets cadeaux', 'price' => 20,'description'=>'fleur 4','image'=>'fleur-4.jpg'],
              ['name' => 'Nos Collection Astrologiques', 'price' => 20,'description'=>'fleur 5','image'=>'fleur-5.jpg'],
               ['name' => 'Nos Brassés de roses', 'price' => 20,'description'=>'fleur 6','image'=>'fleur-6.jpg'],
               ['name' => 'Nos Bouquets de fleurs', 'price' => 20,'description'=>'fleur 20','image'=>'fleur-20.jpg'],
               ['name' => 'Nos Bouquets danniversaire', 'price' => 20,'description'=>'fleur 21','image'=>'fleur-21.jpg'],
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