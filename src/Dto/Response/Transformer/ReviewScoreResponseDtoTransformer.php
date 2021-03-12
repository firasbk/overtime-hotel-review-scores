<?php
declare(strict_types=1);

namespace App\Dto\Response\Transformer;

use App\Dto\Exception\UnexpectedTypeException;
use App\Dto\Response\ReviewScoreResponseDto;
use App\Entity\Review;
use App\Repository\ReviewRepository;

class ReviewScoreResponseDtoTransformer extends AbstractResponseDtoTransformer
{
    private ReviewRepository $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    
    /**
     * @param Review $review
     *
     * @return ReviewResponseDto
     */
    public function transformFromObject($review): ReviewScoreResponseDto
    {
        if (!$review instanceof Review) {
            throw new UnexpectedTypeException('Expected type of Review but got ' . \get_class($review));
        }

        $dto = new ReviewScoreResponseDto();
        $dto->reviewCount = $review->getScore();        
        $dto->score = $review->getScore();
        $dto->hotel = $this->hotelResponseDtoTransformer->transformFromObject($review->getHotel());

        return $dto;
    }
}