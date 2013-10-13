<?php

namespace Acme\SimpleCMSBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\FOSRestController;

class CrudController extends FOSRestController
{
    /**
     * @Route("/", name="dashboard")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    
    /**
     * @Route("/posts.{_format}")
     */
    public function listAction()
    {
        $data = $this->getDoctrine()->getRepository('AcmeSimpleCMSBundle:Post')->findAll();
        $view = $this->view($data, 200)
            ->setTemplate("AcmeSimpleCMSBundle:Crud:list.html.twig")
            ->setTemplateVar('posts')
        ;

        return $this->handleView($view);
    }
}
