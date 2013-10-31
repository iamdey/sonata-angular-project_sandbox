<?php

namespace Acme\SimpleCMSBundle\Controller;

use Acme\SimpleCMSBundle\Entity\Post;
use Acme\SimpleCMSBundle\Form\Angular\PostType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Response;

class UserController extends FOSRestController implements ClassResourceInterface
{
    public function cgetAction()
    {
        $data = $this->getDoctrine()->getRepository('AcmeSimpleCMSBundle:User')->findAll();
        $view = $this->view($data, 200);

        return $this->handleView($view);
    }
}
