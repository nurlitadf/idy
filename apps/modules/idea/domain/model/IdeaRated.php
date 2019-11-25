<?php

namespace Idy\Idea\Domain\Model;

use Idy\Common\Events\DomainEvent;

class IdeaRated implements DomainEvent 
{
    private $name;
    private $email;
    private $title;
    private $rating;

    private $occuredOn;

    public function name()
    {
        return $this->name;
    }

    public function __construct(
        $name, $email, $title, $rating)
    {
        $this->name = $name;
        $this->email = $email;
        $this->title = $title;
        $this->rating = $rating;
    }

    /**
    * @return DateTimeImmutable
    */
    public function occurredOn()
    {
        return $this->occuredOn;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getRating()
    {
        return $this->rating;
    }
}