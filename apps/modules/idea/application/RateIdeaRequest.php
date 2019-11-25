<?php

namespace Idy\Idea\Application;

class RateIdeaRequest
{
    public $ideaId;
    public $value;
    public $user;

    public function __construct($ideaId, $value, $user)
    {
        $this->ideaId = $ideaId;
        $this->value = $value;
        $this->user = $user;
    }
}