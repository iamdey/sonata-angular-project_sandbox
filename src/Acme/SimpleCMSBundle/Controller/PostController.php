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
        $serializer = $this->get('serializer');
        $data = $serializer->deserialize($this->getRequest()->getContent(), 'Acme\SimpleCMSBundle\Entity\Post', 'json');
        $post = $this->getDoctrine()->getManager()->merge($data);
        
        $validator = $this->get('validator');
        $violations = $validator->validate($post);
        
        if ($violations->count() === 0) {
            $post->setCreatedAt(new \DateTime);
            $post->setUpdatedAt(new \DateTime);
            
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($post);
            $em->flush();
            
            return new Response('', 201);
        }
        
        return new Response(json_encode(array('errors' => $violations, 'post' => $post)), 417);
    }
}
