<?php

namespace Acme\SimpleCMSBundle\Controller;

use Acme\SimpleCMSBundle\Entity\Post;
use Acme\SimpleCMSBundle\Form\Angular\PostType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Response;

class PostController extends FOSRestController implements ClassResourceInterface
{
    /**
     * Route("/posts.{_format}", name="acme_simplecms_crud_list", options={"expose"=true})
     */
    public function cgetAction()
    {
        $data = $this->getDoctrine()->getRepository('AcmeSimpleCMSBundle:Post')->findAll();
        $view = $this->view($data, 200)
            ->setTemplate("AcmeSimpleCMSBundle:Crud:list.html.twig")
            ->setTemplateVar('posts')
        ;

        return $this->handleView($view);
    }
    
    /**
     * Route("/posts", name="acme_simplecms_crud_create", requirements={"method"="POST"}, options={"expose"=true})
     */
    public function postAction()
    {
        $data = json_decode($this->getRequest()->getContent(), true);
        $post = new Post;
        $post->setCreatedAt(new \DateTime);
        $post->setUpdatedAt(new \DateTime);
        
        $form = $this->createForm(new PostType(), $post);
        $form->submit($data, true);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($post);
            $em->flush();
            
            return new Response('', 201);
        }
        
        return new Response(json_encode(array('errors' => $form->getErrorsAsString(), 'post' => $post)), 417);
    }
}
