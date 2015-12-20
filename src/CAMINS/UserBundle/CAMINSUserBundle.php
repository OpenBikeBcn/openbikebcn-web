<?php

namespace CAMINS\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CAMINSUserBundle extends Bundle
{
  public function getParent()
  {
      return 'FOSUserBundle';
  }
}
