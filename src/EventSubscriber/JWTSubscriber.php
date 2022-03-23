<?php

namespace App\EventSubscriber;

use DateTime;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class JWTSubscriber implements EventSubscriberInterface
{
    public function onLexikJwtAuthenticationOnJwtCreated(JWTCreatedEvent $event)
    {
        $payload  = $event->getData();
        $user = $event->getUser();
        if(!$user instanceof UserInterface) return;
        $payload['roles'] = $user->getRoles();
        dd($user->getUserIdentifier());
        $payload['username'] = $user->getUserIdentifier();
        $payload['typeId'] = $user->getType()->getId();
        $expires = new DateTime("+2 months");
        $payload['exp'] = $expires->getTimestamp();
        $event->setData($payload);

    }

    public static function getSubscribedEvents()
    {
        return [
            'lexik_jwt_authentication.on_jwt_created' => 'onLexikJwtAuthenticationOnJwtCreated',
        ];
    }
}
