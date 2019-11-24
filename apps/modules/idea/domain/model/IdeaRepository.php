<?php

namespace Idy\Idea\Domain\Model;

interface IdeaRepository
{
    public function create(Idea $idea);
    public function byId(IdeaId $id);
    public function save(Idea $idea);
    public function allIdeas();
}