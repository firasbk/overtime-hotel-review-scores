<?php
namespace App\Util;

use DateTimeImmutable;

class DateRangeGroup {
    const DAILY = 29;
    const WEEKLY = 89;
    
    /**
     * This method calculates the difference between start and end date and decide the group
     * The group is based on const values of weekly, daily, monthly groups
     * 
     * @param $startDate
     * @param $endDate
     * @return string This value of the so called group to be DAY, WEEK, MONTH
     * @author Firas Bou Karroum test
     **/
    public function getGroupByDateRange(string $startDate, string $endDate): ?string
    {
        try{
            $rangeStartDate = new DateTimeImmutable($startDate);
        }
        catch (\Exception $e){
             return null;
        }
        
        try{
            $rangeEndDate = new DateTimeImmutable($endDate);
        } catch (\Exception $e){
            return null;
        }

        $daysRange = $rangeStartDate->diff($rangeEndDate)->days;

        if($daysRange <= self::DAILY) { return 'DAY'; }
        if($daysRange <= self::WEEKLY) { return 'WEEK'; }
        if($daysRange > self::WEEKLY) { return 'MONTH'; }
    }
}