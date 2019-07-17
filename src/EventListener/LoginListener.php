<?php

namespace App\EventListener;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginListener
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $request = Request::createFromGlobals();
        $user = $event->getAuthenticationToken()->getUser();
        $user->setLastLogin(new DateTime());
        $user->setLastIp($request->getClientIp());
        $userAgentStart = strpos($request->headers->get('User-Agent'), '(') + 1;
        $user->setUserAgent(
            substr(
                $request->headers->get('User-Agent'),
                $userAgentStart,
                strpos($request->headers->get('User-Agent'), ')') - $userAgentStart
            )
        );
        $this->em->persist($user);
        $this->em->flush();
    }
}
