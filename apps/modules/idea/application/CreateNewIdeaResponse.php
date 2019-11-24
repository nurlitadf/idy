<?php

namespace Idy\Idea\Application;

use Idy\Idea\Domain\Model\Idea;

class CreateNewIdeaResponse
{
    public $idea;
    public $message;

    public function __construct(Idea $idea)
    {
        $this->idea = $idea;
        $this->message = "success";
    }

}