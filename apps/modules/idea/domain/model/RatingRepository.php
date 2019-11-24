<?php

namespace Idy\Idea\Domain\Model;

interface RatingRepository
{
    public function create(Rating $rating);
    public function byIdeaId($ideaId);
    public function getAverageRatingById($ideaId);
}