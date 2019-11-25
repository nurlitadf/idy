<?php 

namespace Idy\Idea\Infrastructure;

use Idy\Idea\Domain\Model\IdeaId;
use Idy\Idea\Domain\Model\Rating;
use Idy\Idea\Domain\Model\RatingRepository;
use Phalcon\Db\Column;

class SqlRatingRepository implements RatingRepository
{
    private $connection;
    private $statement;
    private $statementTypes;

    public function __construct($di)
    {
        $this->connection = $di->get('db');
        $this->statement = [
            'create' => $this->connection->prepare(
                "INSERT INTO rating VALUES (:value, :ideaId, :user)"
            ),
            'getAverageRatingById' => $this->connection->prepare(
                "SELECT AVG(value) as avg from rating where ideaid = :ideaId"
            ),
            'byIdeaId' => $this->connection->prepare(
                "SELECT * from rating where ideaid = :ideaId"
            )
        ];

        $this->statementTypes = [
            'create' => [
                'value' => Column::BIND_PARAM_INT,
                'ideaId' => Column::BIND_PARAM_STR,
                'user' => Column::BIND_PARAM_STR,
            ],
            'getAverageRatingById' => [
                'ideaId' => Column::BIND_PARAM_STR,
            ],
            'byIdeaId' => [
                'ideaId' => Column::BIND_PARAM_STR,
            ]
        ];
    }

    public function create(Rating $rating)
    {
        // var_dump($rating);
        // exit(0);
        $ratingData = [
            'value' => $rating->value(),
            'ideaId' => $rating->ideaId(),
            'user' => $rating->user(),
        ];

        $this->connection->executePrepared(
            $this->statement['create'],
            $ratingData,
            $this->statementTypes['create']
        );
    }

    public function byIdeaId($ideaId)
    {
        $result = $this->connection->executePrepared(
            $this->statement['byIdeaId'],
            ['ideaId' => $ideaId],
            $this->statementTypes['byIdeaId']
        );

        return $result;
    }

    public function getAverageRatingById($ideaId)
    {
        $result = $this->connection->executePrepared(
            $this->statement['getAverageRatingById'],
            ['ideaId' => $ideaId],
            $this->statementTypes['getAverageRatingById']
        );
        foreach($result as $res){
            return (float)$res['avg'];
        }
    }
}