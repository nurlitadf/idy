<?php

namespace Idy\Idea\Controllers\Web;

use Phalcon\Mvc\Controller;
use Phalcon\Di;

use Idy\Idea\Application\CreateNewIdeaRequest;
use Idy\Idea\Application\CreateNewIdeaService;
use Idy\Idea\Application\ViewAllIdeasService;
use Idy\Idea\Application\RateIdeaRequest;
use Idy\Idea\Application\RateIdeaService;
use Idy\Idea\Application\ViewIdeaService;
use Idy\Idea\Application\UpdateIdeaService;
use Idy\Idea\Application\UpdateIdeaRequest;
use Idy\Idea\Application\VoteIdeaService;
use Idy\Idea\Application\VoteIdeaRequest;

class IdeaController extends Controller
{
    public function indexAction()
    {
        $ideaRepository = Di::getDefault()->get('sql_idea_repository');
        $service = new ViewAllIdeasService($ideaRepository);
        $response = $service->findAll();
        $this->view->setVar('ideas',$response);

        return $this->view->pick('home');
    }

    public function addViewAction ()
    {
        return $this->view->pick('add');
    }

    public function addAction()
    {
        $ideaRepository = Di::getDefault()->get('sql_idea_repository');
        $service = new CreateNewIdeaService($ideaRepository);
        $response = $service->create(
            new CreateNewIdeaRequest(
                $this->request->getPost('title'),
                $this->request->getPost('authorName'),
                $this->request->getPost('authorEmail'),
                $this->request->getPost('description')
            )
        );

        return $this->response->redirect('');
    }

    public function voteAction()
    {
        $ideaRepository = Di::getDefault()->get('sql_idea_repository');
        $service = new ViewIdeaService($ideaRepository);
        $idea = $service->byId($this->dispatcher->getParam('ideaId'));

        $service = new VoteIdeaService($ideaRepository);
        $response = $service->update(
            new VoteIdeaRequest(
                $idea->id(),
                $idea->title(),
                $idea->description(),
                $idea->author()->name(),
                $idea->author()->email(),
                $idea->averageRating(),
                $idea->votes()+1
            )
        );
        return $this->response->redirect('');
    }

    public function rateViewAction()
    {
        $this->view->setVar('ideaId',$this->dispatcher->getParam('ideaId'));

        return $this->view->pick('rate');
    }

    public function rateAction()
    {
        $ratingRepository = Di::getDefault()->get('sql_rating_repository');
        $ideaRepository = Di::getDefault()->get('sql_idea_repository');
        $service = new RateIdeaService($ratingRepository, $ideaRepository);
        $response = $service->create(
            new RateIdeaRequest(
                $this->request->getPost('ideaId'),
                (int)$this->request->getPost('value'),
                $this->request->getPost('user')
            )
        );

        $newAverageRating = $service->getAverageRatingById($this->request->getPost('ideaId'));

        $service = new ViewIdeaService($ideaRepository);
        $idea = $service->byId($this->request->getPost('ideaId'));

        $service = new UpdateIdeaService($ideaRepository);
        $response = $service->update(
            new UpdateIdeaRequest(
                $idea->id()->id(),
                $idea->title(),
                $idea->description(),
                $idea->author()->name(),
                $idea->author()->email(),
                $newAverageRating,
                $idea->votes()
            )
        );

        return $this->response->redirect('');
    }

}