<?php
declare(strict_types=1);

namespace App\Dto\Response;

use JMS\Serializer\Annotation as Serialization;

class ReviewResponseDto {
    /**
     * @Serialization\Type("int")
     */
    public int $score;

    /**
     * @Serialization\Type("DateTime<'Y-m-d\TH:i:s'>")
     */
    public \DateTime $createdDate;
    
    /**
     * @Serialization\Type("App\Dto\Response\HotelResponseDto")
     */
    public HotelResponseDto $hotel;
}