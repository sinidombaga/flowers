<?php

namespace App\Repository;

use App\Entity\Flowers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Flowers>
 */
class FlowersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flowers::class);
    }

    public function findAllFlowers(): array
    {
        return $this->findAll();
    }
    
    /**
     * @param int $id
     * @return Flowers|null Returns a Flowers object or null
     */
    public function findById(int $id): ?Flowers
    {
        return $this->find($id);
    }

     /**
     * Create a new flower entity and persist it to the database
     *
     * @param string $name
     * @param string $description
     * @param float $price
     * @param string $image
     * @return Flowers
     */
    public function createFlower(string $name, string $description, float $price, string $image): Flowers
    {
        $flower = new Flowers();
        $flower->setName($name);
        $flower->setDescription($description);
        $flower->setPrice($price);
        $flower->setImage($image);


        $this->entityManager->persist($flower);
        $this->entityManager->flush();

        return $flower;
    }

    /**
     * Update an existing flower entity
     *
     * @param Flowers $flower
     * @param string $name
     * @param string $description
     * @param float $price
     * @param string $image
     * @return Flowers
     */
    public function updateFlower(Flowers $flower, string $name, string $description, float $price, string $image): Flowers
    {
        $flower->setName($name);
        $flower->setDescription($description);
        $flower->setPrice($price);
        $flower->setImage($image);


        $this->entityManager->flush();

        return $flower;
    }

    /**
     * Delete a flower entity
     *
     * @param Flowers $flower
     */
    public function deleteFlower(Flowers $flower): void
    {
        $this->entityManager->remove($flower);
        $this->entityManager->flush();
    }

    public function findSample(): array
    {
        $flowers= $this->createQueryBuilder('c')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult();
        shuffle($flowers);
        return array_slice($flowers,0,6);
    }

    public function findByCategory(int $categoryId): array
    {
               return $this->createQueryBuilder('f')
            ->andWhere('f.category = :categoryId')
            ->setParameter('categoryId', $categoryId)
            ->getQuery()
            ->getResult();
    }
}