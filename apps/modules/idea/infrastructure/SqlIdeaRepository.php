<?php 

namespace Idy\Idea\Infrastructure;


use Idy\Idea\Domain\Model\IdeaRepository;
use Idy\Idea\Domain\Model\Idea;
use Idy\Idea\Domain\Model\IdeaId;

use Phalcon\Db\Column;

class SqlIdeaRepository implements IdeaRepository
{
    private $connection;
    private $statement;
    private $statementTypes;

    public function __construct($di)
    {
        $this->connection = $di->get('db');
        $this->statement = [
            'create' => $this->connection->prepare(
                "INSERT INTO idea VALUES (:id, :title, :description, :authorName, :authorEmail, :votes)"
            )
        ];

        $this->statementTypes = [
            'create' => [
                'id' => Column::BIND_PARAM_STR,
                'title' => Column::BIND_PARAM_STR,
                'description' => Column::BIND_PARAM_STR,
                'authorName' => Column::BIND_PARAM_STR,
                'authorEmail' => Column::BIND_PARAM_STR,
                'votes' => Column::BIND_PARAM_INT,
            ]
        ];
    }

    public function create(Idea $idea)
    {
        // var_dump($idea);
        // exit(0);
        $ideaData = [
            'id' => $idea->id()->id(),
            'title' => $idea->title(),
            'description' => $idea->description(),
            'authorName' => $idea->author()->name(),
            'authorEmail' => $idea->author()->email(),
            'votes' => $idea->votes(),
        ];

        $success = $this->connection->executePrepared(
            $this->statement['create'],
            $ideaData,
            $this->statementTypes['create']
        );
        
    }

    public function byId(IdeaId $id)
    {

    }

    public function save(Idea $idea)
    {

    }

    public function allIdeas()
    {

    }
    
}