<?php

namespace Idy\Idea\Application;

use Idy\Idea\Domain\Model\RatingRepository;
use Idy\Idea\Domain\Model\Rating;
use Idy\Idea\Domain\Model\IdeaRated;
use Idy\Idea\Domain\Model\IdeaRepository;
use Idy\Idea\Domain\Model\Idea;
use Idy\Idea\Domain\Model\IdeaId;
use Idy\Idea\Domain\Model\Author;
use Idy\Common\Events\DomainEventPublisher;

class RateIdeaService
{
    private $ratingRepository;
    private $ideaRepository;

    public function __construct(RatingRepository $ratingRepository, IdeaRepository $ideaRepository)
    {
        $this->ratingRepository = $ratingRepository;
        $this->ideaRepository = $ideaRepository;
    }

    public function getIdeabyId($id)
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

    public function create(RateIdeaRequest $request)
    {
        $rating = new Rating($request->ideaId, $request->value, $request->user);

        $ideaRatings = $this->ratingRepository->byIdeaId($request->ideaId);
    
        $ratings = array();
        foreach ($ideaRatings as $ideaRating) {
            array_push($ratings, new Rating($ideaRating['ideaId'], (int)$ideaRating['value'], $ideaRating['user']));
        }

        $exist = false;
        foreach ($ratings as $existingRating) {
            if ($existingRating->equals($rating)) {
                $exist = true;
                break;
            }
        }

        if(!$exist&&$rating->isValid()){
            $this->ratingRepository->create($rating);

            $idea = $this->getIdeabyId($request->ideaId);

            DomainEventPublisher::instance()->publish(
                new IdeaRated($idea->author()->name(), $idea->author()->email(),
                $idea->title(), $rating->value())
            );
        }

    }

    public function getAverageRatingById($id)
    {
        return $this->ratingRepository->getAverageRatingById($id);
    }
}