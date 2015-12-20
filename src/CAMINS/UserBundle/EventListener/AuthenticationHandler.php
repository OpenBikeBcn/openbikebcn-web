<?php

namespace CAMINS\UserBundle\EventListener;

use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class AuthenticationHandler implements AuthenticationFailureHandlerInterface
{

  public function onAuthenticationSuccess(Request $request, TokenInterface $token)
  {
      if ($request->isXmlHttpRequest()) {
          $result = array('success' => true);
          return new Response(json_encode($result));
      } else {
          // Handle non XmlHttp request here
      }
  }

  public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
  {
    $referer = $request->headers->get('referer');
    //$request->getSession()->setFlash('error', $exception->getMessage());

    return new RedirectResponse($referer);
  }

}
