<?php

namespace Tickit\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * The core controller class provides base methods for all controller classes
 * in the application.
 *
 * @author James Halsall <james.t.halsall@googlemail.com>
 */
class CoreController extends Controller
{

    /**
     * Returns an instance of the user manager provided by FOSUserBundle
     *
     * @return \FOS\UserBundle\Entity\UserManager;
     */
    protected function _getUserManager()
    {
        return $this->container->get('fos_user.user_manager');
    }

    /**
     * Returns an instance of the currently logged in user. If no user is logged in
     * this function will return null
     *
     * @return \Tickit\UserBundle\Entity\User
     */
    protected function _getCurrentUser()
    {
        $token = $this->get('security.context')->getToken();
        if(null === $token) return $token;
        return $token->getUser();
    }

}