<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/** Based on sfGuardBasicSecurityFilter but decoupled from sfBasicSecurityFilter
 *  so that it can work on paths that are not secure.
 *  
 *  Place this filter before the security filter in filters.yml e.g.
 *  ...
 *  rememberme:
 *    class: sfGuardRememberMeFilter
 *  security: ~
 *  ...
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Ed Lucas <elucas@whiteoctober.co.uk>
 * @version    SVN: $Id$
 */
class sfGuardRememberMeFilter extends sfFilter
{
  public function execute ($filterChain)
  {
    if ($this->isFirstCall() and !$this->getContext()->getUser()->isAuthenticated())
    {
      if ($cookie = $this->getContext()->getRequest()->getCookie(sfConfig::get('app_sf_guard_plugin_remember_cookie_name', 'sfRemember')))
      {
        $c = new Criteria();
        $c->add(sfGuardRememberKeyPeer::REMEMBER_KEY, $cookie);
        $rk = sfGuardRememberKeyPeer::doSelectOne($c);
        if ($rk && $rk->getSfGuardUser())
        {
          $this->getContext()->getUser()->signIn($rk->getSfGuardUser());
        }
      }
    }

    $filterChain->execute();
  }
}
