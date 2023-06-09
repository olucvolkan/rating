<?php

namespace App\Repository;

use App\Entity\Feedback;
use App\Entity\Ratings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ratings>
 *
 * @method Ratings|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ratings|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ratings[]    findAll()
 * @method Ratings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RatingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ratings::class);
    }

    public function save(Ratings $entity, bool $flush = false): Ratings
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
        return $entity;
    }

    public function remove(Ratings $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param Feedback $feedback
     * @return int|mixed|string|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getTotalRatingScoreCount(Feedback $feedback)
    {
        return $this->createQueryBuilder('r')
            ->select('SUM(r.score) as totalScoreCount')
            ->where('r.feedback =:feedback')
            ->setParameter('feedback', $feedback)
            ->getQuery()->getOneOrNullResult();

    }

    /**
     * @param Feedback $feedback
     * @return int|mixed|string|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getRatingCount(Feedback $feedback)
    {
        return $this->createQueryBuilder('r')
            ->select('COUNT(r) as totalCount')
            ->where('r.feedback =:feedback')
            ->setParameter('feedback', $feedback)
            ->getQuery()->getOneOrNullResult();

    }

}
