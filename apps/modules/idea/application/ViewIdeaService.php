<?php

namespace Idy\Idea\Application;

use Idy\Idea\Domain\Model\IdeaRepository;
use Idy\Idea\Domain\Model\Idea;
use Idy\Idea\Domain\Model\IdeaId;
use Idy\Idea\Domain\Model\Author;

class ViewIdeaService
{
    private $ideaRepository;

    public function __construct(
        IdeaRepository $ideaRepository)
    {
        $this->ideaRepository = $ideaRepository;
    }

    public function byId($id)
    {
        $result = $this->ideaRepository->byId($id);
        foreach($result as $res){
            // var_dump($res);
            return new Idea(
                new IdeaId($res['id']),
                    $res['title'],
                    $res['description'],
                    new Author(
                        $res['author_name'],
                        $res['author_email'],
                    ),
                    $res['averageRating'],
                    $res['votes'],
                );
        }
        // exit(0);
    }
}