<?php

namespace Acme\SimpleCMSBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;

/**
 * Description of CategoryController
 *
 * @author dey
 */
class CategoryController extends FOSRestController implements ClassResourceInterface
{

    public function cgetAction()
    {
        $data = $this->getDoctrine()->getRepository('AcmeSimpleCMSBundle:Category')->findAll();
        $view = $this->view($data, 200);

        return $this->handleView($view);
    }
}