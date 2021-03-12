<?php

namespace App\Repository;

use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Review|null find($id, $lockMode = null, $lockVersion = null)
 * @method Review|null findOneBy(array $criteria, array $orderBy = null)
 * @method Review[]    findAll()
 * @method Review[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReviewRepository extends ServiceEntityRepository
{    
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    public function getDateRangeReviewsScoresByHotel(string $startRangeDate, string $endRangeDate, string $hotelId, string $groupByDateRange): array
    {        
       return $this->createQueryBuilder('r')
                ->select('count(r.id) as review_count', 'avg(r.score) as average_score', 
                        $groupByDateRange . '(r.createdDate) as group_range')
                ->where('r.hotel = :hotelid')
                ->andWhere('r.createdDate BETWEEN :from AND :to')
                ->groupBy('group_range')
                ->orderBy('group_range')
                ->setParameter('from', $startRangeDate)
                ->setParameter('to', $endRangeDate)
                ->setParameter('hotelid', $hotelId)
                ->getQuery()
                ->getResult();
    }
//    
//    public function getDateRangeReviewsScoresByHotelDTO(string $startDate, string $endDate, string $hotelId): array
//    {
//        $from = new DateTimeImmutable($startDate);
//        $to = new DateTimeImmutable($endDate);
//        // get the group category if daily, weekly, monthly
//        $group = $this->getGroupByDateRange($from, $to);
//        
//       return $this->createQueryBuilder('r')
//                ->select('NEW App\Dto\Response\ReviewScoreResponseDto(count(r.id), avg(r.score), '.$group . '(r.createdDate))' )
//                ->where('r.hotel = :hotelid')
//                ->andWhere('r.createdDate BETWEEN :from AND :to')
//                ->groupBy('group_range')
//                ->orderBy('group_range')
//                ->setParameter('from', $from)
//                ->setParameter('to', $to)
//                ->setParameter('hotelid', $hotelId)
//                ->getQuery()
//                ->getResult();
//    }
//    
//    public function findOneBySomeField(string $startDate, string $endData, int $hotelId): array
//    {
//        $result = array();
//        $from = new DateTimeImmutable($startDate);
//        $to = new DateTimeImmutable($endData);
//        // get the group category if daily, weekly, monthly
//        $group = $this->getGroupByDateRange($from, $to);
//        
//        $qb = $this->createQueryBuilder('r');
//            $qb->select('count(r.id) as review_count', 'avg(r.score) as average_score', 
//                        $group . '(r.createdDate) as group_range')
//                ->where('r.hotel = :hotelid')
//                ->andWhere('r.createdDate BETWEEN :from AND :to')
//                ->groupBy('group_range')
//                ->setParameter('from', $from)
//                ->setParameter('to', $to)
//                ->setParameter('hotelid', $hotelId);
////                ->getQuery()
////                ->getResult();
//            
//            $iterator = $qb->getQuery()->iterate(['from' => $from, 'to' => $to, 'hotelid' => $hotelId]);
//            foreach ($iterator as $review) {
//                //echo $review[0]->id . ', ' . $review[0]->name . PHP_EOL;
//                $result["average_score"][] = $review[0]->average_score;
//                $this->detach($review);
//            }
//            
//            return $result;
//    }
}