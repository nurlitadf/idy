<?php

namespace Idy\Idea\Application;

class CreateNewIdeaRequest
{
    public $ideaTitle;
    public $authorName;
    public $authorEmail;
    public $description;

    public function __construct($ideaTitle, $authorName, $authorEmail, $description)
    {
        $this->ideaTitle = $ideaTitle;
        $this->authorName = $authorName;
        $this->authorEmail = $authorEmail;
        $this->description = $description;
    }

}