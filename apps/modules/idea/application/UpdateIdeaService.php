<?php

namespace Idy\Idea\Application;

use Idy\Idea\Domain\Model\IdeaRepository;
use Idy\Idea\Domain\Model\Author;
use Idy\Idea\Domain\Model\Idea;

class UpdateIdeaService
{
    private $ideaRepository;

    public function __construct(
        IdeaRepository $ideaRepository)
    {
        $this->ideaRepository = $ideaRepository;
    }

    public function update(UpdateIdeaRequest $request)
    {
        $author = new Author(
            $request->authorName, 
            $request->authorEmail
        );

        $idea = new Idea(
            $request->id,
            $request->ideaTitle,
            $request->description,
            $author,
            $request->averageRating,
            $request->votes
        );

        $this->ideaRepository->save($idea);

        return new CreateNewIdeaResponse($idea);
    }
}