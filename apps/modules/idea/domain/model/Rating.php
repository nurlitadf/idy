<?php

namespace Idy\Idea\Domain\Model;

class Rating
{
    private $ideaId;
    private $value;
    private $user;

    public function __construct($ideaId, $value, $user) 
    {
        $this->ideaId = $ideaId;
        $this->value = $value;
        $this->user = $user;
    }

    public function ideaId()
    {
        return $this->ideaId;
    }

    public function value()
    {
        return $this->value;
    }

    public function user()
    {
        return $this->user;
    }

    public function equals(Rating $rating) 
    {
        return $this->user === $rating->user() && 
                $this->value === $rating->value();
    }

    public function isValid() 
    {
        if ($this->user && $this->value && $this->value > 0 && $this->value <= 5) {
            return true;
        }
        return false;
    }

}