<?php
declare(strict_types=1);

namespace App\Dto\Response;

use JMS\Serializer\Annotation as Serialization;

class ReviewScoreResponseDto {
    /**
     * @Serialization\Type("int")
     */
    private int $reviewCount;

    /**
     * @Serialization\Type("string")
     */
    private string $averageScore;
    
    /**
     * @Serialization\Type("string")
     */
    private string $dateGroup;
    
    public function __construct($reviewCount = null, $averageScore = null, $dateGroup=null)
    {
        $this->reviewCount = $reviewCount;
        $this->averageScore = $averageScore;
        $this->dateGroup = $dateGroup;
    }

}
