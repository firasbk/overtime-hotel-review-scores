<?php
declare(strict_types=1);

namespace App\Dto\Response;

use JMS\Serializer\Annotation as Serialization;

class HotelResponseDto {
    /**
     * @Serialization\Type("string")
     */
    public string $name;
}