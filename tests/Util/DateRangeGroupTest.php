<?php
namespace App\Tests\Util;

use App\Util\DateRangeGroup;
use PHPUnit\Framework\TestCase;
/*
 * 
 *  UNIT TEST
 * 
 */
class DateRangeGroupTest extends TestCase{
    
    public function testGetGroupByDateRangeDay()
    {
        $dateRangeGroup = new DateRangeGroup();
        
        $startDate = '2009-10-01';
        $endDate = '2009-10-11';

        $result = $dateRangeGroup->getGroupByDateRange($startDate, $endDate);

        // check if DAILY returned as difference only 5 days which is less than 30 days
        $this->assertEquals('DAY', $result);
    }
    
    public function testGetGroupByDateRangeWeek()
    {
        $dateRangeGroup = new DateRangeGroup();
        
        $startDate = '2009-10-01';
        $endDate = '2009-11-07';

        $result = $dateRangeGroup->getGroupByDateRange($startDate, $endDate);

        // check if WEEKLY returned as difference only 5 days which is less than 30 days
        $this->assertEquals('WEEK', $result);
    }
    
    public function testGetGroupByDateRangeMonth()
    {
        $dateRangeGroup = new DateRangeGroup();
        
        $startDate = '2009-07-01';
        $endDate = '2009-10-11';

        $result = $dateRangeGroup->getGroupByDateRange($startDate, $endDate);

        // check if Monthly returned as difference only 5 days which is less than 30 days
        $this->assertEquals('MONTH', $result);
    }
    
    public function testGetGroupByDateRange()
    {
        $dateRangeGroup = new DateRangeGroup();
        
        $startDate = 'invalid';
        $endDate = 'testwrong';

        $result = $dateRangeGroup->getGroupByDateRange($startDate, $endDate);

        // check if Monthly returned as difference only 5 days which is less than 30 days
        $this->assertEquals(null, $result);
    }    
    
}
