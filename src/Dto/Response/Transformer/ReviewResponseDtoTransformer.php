<?php
declare(strict_types=1);

namespace App\Dto\Response\Transformer;

use App\Dto\Exception\UnexpectedTypeException;
use App\Dto\Response\ReviewResponseDto;
use App\Entity\Review;
use App\Dto\Response\Transformer\HotelResponseDtoTransformer;

class ReviewResponseDtoTransformer extends AbstractResponseDtoTransformer
{
    private HotelResponseDtoTransformer $hotelResponseDtoTransformer;

    public function __construct(HotelResponseDtoTransformer $hotelResponseDtoTransformer) {
        $this->hotelResponseDtoTransformer = $hotelResponseDtoTransformer;       
    }
    
    /**
     * @param Review $review
     *
     * @return ReviewResponseDto
     */
    public function transformFromObject($review): ReviewResponseDto
    {
        if (!$review instanceof Review) {
            throw new UnexpectedTypeException('Expected type of Review but got ' . \get_class($review));
        }

        $dto = new ReviewResponseDto();
        $dto->createdDate = $review->getCreatedDate();
        $dto->score = $review->getScore();
         $dto->hotel = $this->hotelResponseDtoTransformer->transformFromObject($review->getHotel());

        return $dto;
    }
}