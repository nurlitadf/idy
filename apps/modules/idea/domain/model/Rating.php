<?php

namespace Idy\Idea\Domain\Model;

class Rating
{
    private $ideaId;
    private $value;

    public function __construct($ideaId, $value) 
    {
        $this->ideaId = $ideaId;
        $this->value = $value;
    }

    public function ideaId()
    {
        return $this->ideaId;
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(Rating $rating) 
    {
        return $this->user === $rating->user() && 
                $this->value === $rating->value();
    }

    public function isValid() 
    {
        if ($user && $value && $value > 0 && $value <= 5) {
            return true;
        }
        return false;
    }

}