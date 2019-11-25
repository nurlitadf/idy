<?php

namespace Idy\Idea\Application;

use Phalcon\Di;

use Idy\Common\Events\DomainEventSubscriber;
use Idy\Idea\Domain\Model\IdeaRated;


class SendRatingNotificationService implements DomainEventSubscriber
{
    public function handle($aDomainEvent)
    {
        $mailTemplateParams = [
            'name' => $aDomainEvent->getName(),
            'rating' => $aDomainEvent->getRating(),
            'title' => $aDomainEvent->getTitle(),
        ];

        $mailService = Di::getDefault()->get('mail');
        $message = $mailService
            ->createMessageFromView('mail/idea_rated_plain', $mailTemplateParams)
            ->to($aDomainEvent->getEmail(), $aDomainEvent->getName())
            ->subject('Someone give rating to your Idea');
        
        $message->send();
    }

    public function isSubscribedTo($aDomainEvent)
    {
        return $aDomainEvent instanceof IdeaRated;
    }
}