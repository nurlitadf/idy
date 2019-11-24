<?php

namespace Idy\Idea\Application;

use Idy\Idea\Domain\Model\IdeaRepository;
use Idy\Idea\Domain\Model\Author;
use Idy\Idea\Domain\Model\Idea;

class CreateNewIdeaService
{
    private $ideaRepository;

    public function __construct(
        IdeaRepository $ideaRepository)
    {
        $this->ideaRepository = $ideaRepository;
    }

    public function create(CreateNewIdeaRequest $request)
    {
        $author = new Author(
            $request->authorName, 
            $request->authorEmail
        );

        $idea = Idea::makeIdea(
            $request->ideaTitle,
            $request->description,
            $author
        );

        $this->ideaRepository->create($idea);

        return new CreateNewIdeaResponse($idea);
    }

}