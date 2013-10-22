<?php

namespace Acme\SimpleCMSBundle\Controller;

use Acme\SimpleCMSBundle\Form\Angular\PostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Exception\InvalidArgumentException;

/**
 * Description of DashboardController
 *
 * @author dey
 */
class DashboardController extends Controller {

    /**
     * @Route("/", name="dashboard")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    
    
    /**
     * @param str$name
     * @return Response
     * @throws NotFoundHttpException
     * 
     * @Route("/partials/{name}.html", name="partials", options={"expose"=true})
     */
    public function partialsAction($name)
    {
        if (!in_array($name, array('edit', 'show', 'create', 'list'))) {
            throw $this->createNotFoundException();
        }
        
        $parameters = $this->getParametersForView($name);
        
        return $this->render("AcmeSimpleCMSBundle:Crud:partials/$name.html.twig", $parameters);
    }
    
    /**
     * @param type $name
     * @return array
     * @throws InvalidArgumentException
     */
    protected function getParametersForView($name)
    {
        $parameters = array();
        
        switch ($name) {
            case 'list':
            case 'show':
            case 'edit':
                break;
            case 'create':
                $form = $this->createForm(new PostType());
                $parameters['form'] = $form->createView();
                break;
            default:
                throw new InvalidArgumentException;
                break;
        }
        
        return $parameters;
    }
}
