<?php

namespace Idy\Idea\Application;

use Idy\Idea\Domain\Model\IdeaRepository;
use Idy\Idea\Domain\Model\Idea;
use Idy\Idea\Domain\Model\IdeaId;
use Idy\Idea\Domain\Model\Author;

class ViewAllIdeasService
{
    private $ideaRepository;

    public function __construct(IdeaRepository $ideaRepository)
    {
        $this->ideaRepository = $ideaRepository;
    }

    public function findAll()
    {
        $result = $this->ideaRepository->allIdeas();
        $ideas = array();
        foreach($result as $res){
            // var_dump($res);
            array_push($ideas,
                new Idea(
                    new IdeaId($res['id']),
                    $res['title'],
                    $res['description'],
                    new Author(
                        $res['author_name'],
                        $res['author_email'],
                    ),
                    $res['averageRating'],
                    $res['votes'],
                ),
            );
        }
        // exit(0);
        return $ideas;
    }
}