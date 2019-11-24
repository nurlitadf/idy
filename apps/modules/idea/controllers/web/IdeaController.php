<?php

namespace Idy\Idea\Controllers\Web;

use Phalcon\Mvc\Controller;
use Phalcon\Di;

use Idy\Idea\Application\CreateNewIdeaRequest;
use Idy\Idea\Application\CreateNewIdeaService;

class IdeaController extends Controller
{
    public function indexAction()
    {
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

        return $this->view->pick('add');
    }

    public function voteAction()
    {

    }

    public function rateAction()
    {
        
    }

}