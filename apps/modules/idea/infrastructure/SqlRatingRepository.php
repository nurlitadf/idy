<?php 

namespace Idy\Idea\Infrastructure;

use Phalcon\Db\Column;

class SqlRatingRepository
{
    private $connection;
    private $statement;
    private $statementTypes;

    public function __construct($di)
    {
        $this->connection = $di->get('db');
        $this->statement = [
            'create' => $this->connection->prepare(
                "INSERT INTO rating VALUES (:value, :idIdea)"
            )
        ];

        $this->statementTypes = [
            'create' => [
                'value' => Column::BIND_PARAM_INT,
                'ideaId' => Column::BIND_PARAM_STR,
            ]
        ];
    }

    public function create(Rating $rating)
    {
        $ratingData = [
            'value' => $rating->value(),
            'ideaId' => $rating->ideaId()
        ];

        $this->connection->executePrepared(
            $this->statement['create'],
            $ratingData,
            $this->statementTypes['create']
        );
    }
}