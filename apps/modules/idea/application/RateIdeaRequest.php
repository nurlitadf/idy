<?php

namespace Idy\Idea\Application;

class RateIdeaRequest
{
    public $ideaId;
    public $value;

    public function __construct($ideaId, $value)
    {
        $this->ideaId = $ideaId;
        $this->value = $value;
    }
}