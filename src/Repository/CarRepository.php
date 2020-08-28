<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function findFilter($form)
    {
        $qb = $this->createQueryBuilder('c');

        if ($form['model']) {
            $qb->andWhere('c.model = :model')
                ->setParameter('model', $form['model']);
        }

        if ($form['year']) {
            $qb->andWhere('c.year = :year')
                ->setParameter('year', $form['year']);
        }

        if ($form['price']) {
            $qb->andWhere('c.price = :price')
                ->setParameter('price', $form['price']);
        }

        if ($form['color']) {
            $qb->andWhere('c.color = :color')
                ->setParameter('color', $form['color']);
        }

        if ($form['isNew']) {
            if ($form['isNew'] === 'yes') {
                $qb->andWhere('c.isNew = true');
            } else {
                $qb->andWhere('c.isNew = false');
            }
        }

        return $qb->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
