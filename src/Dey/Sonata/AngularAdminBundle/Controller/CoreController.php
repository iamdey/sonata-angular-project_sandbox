<?php

namespace Dey\Sonata\AngularAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Description of CoreController
 *
 * @author dey
 */
class CoreController extends Controller 
{
    /**
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     * @Template()
     */
    public function dashboardAction() 
    {
        return array();
    }
}
