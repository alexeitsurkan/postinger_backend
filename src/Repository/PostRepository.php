<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public const PAGINATOR_PER_PAGE = 10;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function add(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getPostPaginator($user_id, $page = 1, )
    {
        $offset = --$page * self::PAGINATOR_PER_PAGE;
        $query = $this->createQueryBuilder('p')
            ->andWhere('p.user = :user')
            ->setParameter('user', $user_id)
            ->orderBy('p.datetime', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults(self::PAGINATOR_PER_PAGE)
            ->getQuery();

        return new Paginator($query);
    }

    public function getAllForCurrentTime(int $time): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.datetime = :time')
            ->setParameter('time', $time)
            ->getQuery()
            ->getResult()
        ;
    }
}
