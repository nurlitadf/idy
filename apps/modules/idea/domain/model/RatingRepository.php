<?php

namespace Idy\Idea\Domain\Model;

interface RatingRepository
{
    public function create(Rating $rating);
    public function byIdeaId(IdeaId $ideaId);
}