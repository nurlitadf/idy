<?php

namespace Idy\Idea\Application;

class UpdateIdeaRequest
{
    public $id;
    public $ideaTitle;
    public $authorName;
    public $authorEmail;
    public $description;
    public $averageRating;
    public $votes;

    public function __construct($id, $ideaTitle, $authorName, $authorEmail, $description, $averageRating, $votes)
    {
        $this->id = $id;
        $this->ideaTitle = $ideaTitle;
        $this->authorName = $authorName;
        $this->authorEmail = $authorEmail;
        $this->description = $description;
        $this->averageRating = $averageRating;
        $this->votes = $votes;
    }

}