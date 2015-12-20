<?php

namespace OPENCITY\bikesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Default controller.
 *
 * @Route("/")
 */
class DefaultController extends Controller
{
    public function indexAction()
    {
      $user = $this->getUser();

			if (!is_null($user)) {

          $userRole = $user->getUserRole();

          if ($userRole == "OPERATOR" || $userRole == "MANAGER" || $userRole == "ADMIN" ) {
  					return $this->redirect($this->generateUrl('station_home'));
  				} else {
  					return $this->redirect($this->generateUrl('fos_user_security_login'));
  				}

      } else {
					return $this->redirect($this->generateUrl('fos_user_security_login'));
			}
	  }

}
