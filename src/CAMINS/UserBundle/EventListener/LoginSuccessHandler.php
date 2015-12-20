<?php

namespace CAMINS\UserBundle\EventListener;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;

use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\SecurityContextInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;


class LoginSuccessHandler implements \Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface
{
    protected $router;
    protected $security;

    protected $em;

    public function __construct(Router $router, SecurityContext $security)
    {
        $this->router = $router;
        $this->security = $security;
    }


    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {

      $referer = $request->headers->get("referer");
      $user = $token->getUser();

      if (strpos($referer,'mobile') !== false) {
          $response = new Response();
          $response->setContent(json_encode(array(
              'userId' => $user->getId(),
              'email' => $user->getEmail(),
              'username' => $user->getUsername(),
          )));
          $response->headers->set('Content-Type', 'application/json');

      } else {
          $response = new RedirectResponse($this->router->generate('station_home'));
      }
    		return $response;

    }

}
