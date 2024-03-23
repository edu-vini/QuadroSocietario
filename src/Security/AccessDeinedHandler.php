<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeinedHandler implements AccessDeniedHandlerInterface {
    public function __construct(private UrlGeneratorInterface $urlGenerator){
    }
    public function handle(Request $request, AccessDeniedException $accessDeniedException): ?RedirectResponse {        
        $request->getSession()->getFlashBag()->add('warning', 'Você não tem acesso a essa página!');
        return new RedirectResponse($this->urlGenerator->generate('home'));
    }
}