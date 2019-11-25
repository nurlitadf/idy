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
                "INSERT INTO idea VALUES (:id, :title, :description, :authorName, :authorEmail, :votes, :averageRating)"
            ),
            'findAll' => $this->connection->prepare(
                "SELECT * from idea"
            ),
            'update' => $this->connection->prepare(
                "UPDATE idea 
                SET title = :title, description = :description, author_name = :authorName, author_email = :authorEmail, votes = :votes, averageRating = :averageRating
                WHERE id = :id"
            ),
            'findById' => $this->connection->prepare(
                "SELECT * from idea WHERE id = :id"
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
                'averageRating' => Column::BIND_PARAM_DECIMAL,
            ],
            'update' => [
                'id' => Column::BIND_PARAM_STR,
                'title' => Column::BIND_PARAM_STR,
                'description' => Column::BIND_PARAM_STR,
                'authorName' => Column::BIND_PARAM_STR,
                'authorEmail' => Column::BIND_PARAM_STR,
                'votes' => Column::BIND_PARAM_INT,
                'averageRating' => Column::BIND_PARAM_DECIMAL,
            ],
            'findById' => [
                'id' => Column::BIND_PARAM_STR,
            ]
        ];
    }

    public function create(Idea $idea)
    {
        $ideaData = [
            'id' => $idea->id()->id(),
            'title' => $idea->title(),
            'description' => $idea->description(),
            'authorName' => $idea->author()->name(),
            'authorEmail' => $idea->author()->email(),
            'votes' => $idea->votes(),
            'averageRating' => $idea->averageRating(),
        ];

        $this->connection->executePrepared(
            $this->statement['create'],
            $ideaData,
            $this->statementTypes['create']
        );
        
    }

    public function byId($id)
    {
        return $this->connection->executePrepared(
            $this->statement['findById'],
            ['id' => $id],
            $this->statementTypes['findById']
        );
    }

    public function save(Idea $idea)
    {
        $ideaData = [
            'id' => $idea->id()->id(),
            'title' => $idea->title(),
            'description' => $idea->description(),
            'authorName' => $idea->author()->name(),
            'authorEmail' => $idea->author()->email(),
            'votes' => $idea->votes(),
            'averageRating' => $idea->averageRating(),
        ];

        $this->connection->executePrepared(
            $this->statement['update'],
            $ideaData,
            $this->statementTypes['update']
        );

    }

    public function allIdeas()
    {
        $result = $this->connection->executePrepared(
            $this->statement['findAll'],
            [],
            []
        );

        return $result;
    }
    
}