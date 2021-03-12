<?php
declare(strict_types=1);

namespace App\Dto\Response\Transformer;

use App\Dto\Exception\UnexpectedTypeException;
use App\Dto\Response\HotelResponseDto;
use App\Entity\Hotel;

class HotelResponseDtoTransformer extends AbstractResponseDtoTransformer{
    
    /**
     * @param Hotel $hotel
     *
     * @return HotelResponseDto
     */
    public function transformFromObject($hotel): HotelResponseDto
    {
        if (!$hotel instanceof Hotel) {
            throw new UnexpectedTypeException('Expected type of Hotel but got ' . \get_class($hotel));
        }

        $dto = new HotelResponseDto();
        $dto->name = $hotel->getName();

        return $dto;
    }
}
