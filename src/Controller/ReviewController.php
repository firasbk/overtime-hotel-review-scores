<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Review;
 use App\Dto\Response\Transformer\ReviewResponseDtoTransformer;
 use Symfony\Component\HttpFoundation\Response;
 use App\Service\ReviewService;
 use App\Dto\Response\ReviewScoreResponseDto;
 
 /**
  * Class ReviewController
  * @package App\Controller
  * @Route("/api/v1", name="review_api")
  */
class ReviewController extends AbstractApiController{
    
    private ReviewResponseDtoTransformer $reviewResponseDtoTransformer;
    private ReviewService $reviewService;
    
    public function __construct(ReviewResponseDtoTransformer $reviewResponseDtoTransformer, ReviewService $reviewService)
    {
        $this->reviewResponseDtoTransformer = $reviewResponseDtoTransformer;
        $this->reviewService = $reviewService;
    }
    
  /**
   * @param $hotelId
   * @param $request
   * @return JsonResponse
   * @Route("/overtime-reviews-scores/{hotelId}", name="overtime_reviews_scores_list", methods={"GET"})
   */
    public function getOvertimeReviewsScores(string $hotelId, Request $request) : Response
    {
        $startDate = $request->get('from');
        $endData = $request->get('to');
        
        $results = $this->reviewService->getDateRangeReviewsScoresByHotel($startDate, $endData, $hotelId);
        if(empty($results) || (isset($results["success"]) && $results["success"]=='error')){
            return $this->responseError($results);
        }
        foreach ($results as $result) {
             $dtos[] = new ReviewScoreResponseDto($result['review_count'], $result['average_score'], $result['group_range']);
                    // We can validate this part of code if we have users and roles but now I don't have so I comment it out
                   // if (in_array('ROLE_ADMIN', $this->getUser()->getRoles(), true)*/) {
                  //     $this->addSerializationGroup(AbstractApiController::SERIALIZATION_GROUP_ADMIN);
                 //  }
        }
       return $this->respond($dtos);
    }
    
  /**
   * This method get the first review of the list and apply DTO and transformation on it
   * 
   * I kept it only for testing and dummy
   * 
   * @return Response
   * @Route("/reviews", name="reviews_list", methods={"GET"})
   */
    public function indexAction(): Response
    {
        $reviews = $this->getDoctrine()->getRepository(Review::class)->findAll();

        $review = reset($reviews);
        $dto = $this->reviewResponseDtoTransformer->transformFromObject($review);
        return $this->respond($dto);
    }
  
    /**
   * Returns a JSON response
   *
   * @param array $data
   * @param $status
   * @param array $headers
   * @return JsonResponse
   */
  public function responseError($data, $status = 200, $headers = []) : JsonResponse
  {
   return new JsonResponse($data, $status, $headers);
  }
}
