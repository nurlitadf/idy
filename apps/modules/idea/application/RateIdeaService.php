<?php

namespace Idy\Idea\Application;

use Idy\Idea\Domain\Model\RatingRepository;
use Idy\Idea\Domain\Model\Rating;

class RateIdeaService
{
    private $ratingRepository;

    public function __construct(RatingRepository $ratingRepository)
    {
        $this->ratingRepository = $ratingRepository;
    }

    public function create(RateIdeaRequest $request)
    {
        $rating = new Rating($request->ideaId, $request->value);
        $this->ratingRepository->create($rating);
    }

    public function getAverageRatingById($id)
    {
        return $this->ratingRepository->getAverageRatingById($id);
    }
}