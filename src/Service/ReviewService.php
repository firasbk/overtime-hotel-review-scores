<?php

namespace App\Service;

use App\Repository\ReviewRepository;
use App\Util\DateRangeGroup;

class ReviewService {
    
    private ReviewRepository $reviewRepo;
    private DateRangeGroup $dateRangeGroup;
    public function __construct(ReviewRepository $reviewRepo, DateRangeGroup $dateRangeGroup)
    {
        $this->reviewRepo = $reviewRepo;
        $this->dateRangeGroup = $dateRangeGroup;
    }
    
    /*
     * This method calls the repository main query that retrieves
     * the records of groups by hotel id with s date range based on start and end date passed.
     * 
     * The group is based on const values of weekly, daily, monthly groups
     * 
     * @param $startDate
     * @param $endDate
     * @param $hotelId
     * @return array It returns as an array the results retrieved from repository
     * @author Firas Bou Karroum
     */ 
    public function getDateRangeReviewsScoresByHotel(string $startDate, string $endDate, string $hotelId): array
    {        
        // get the group category if daily, weekly, monthly
        $groupByDateRange = $this->dateRangeGroup->getGroupByDateRange($startDate, $endDate);
        if(empty($groupByDateRange) || !(in_array($groupByDateRange, ['DAY','WEEK','MONTH']) ) ){
            return array("success"=>"error", "message"=>"Invalid Date Format");
        }
        return $this->reviewRepo->getDateRangeReviewsScoresByHotel($startDate,$endDate, $hotelId, $groupByDateRange);
    }
}
