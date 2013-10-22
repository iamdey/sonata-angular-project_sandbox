<?php

namespace Acme\SimpleCMSBundle\Form\Angular;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of PostType
 *
 * @author dey
 */
class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', array('attr' => array('ng-model' => "post.title")))
            ->add('content', 'textarea', array('attr' => array('ng-model' => "post.content")))
//            ->add('author', 'choice', array('attr' => array('ng-model' => "post.author")))
            ->add('slug', 'text', array('attr' => array('ng-model' => "post.slug")))
//            ->add('category', 'choice', array('attr' => array('ng-model' => "post.category")))
            ->add('submit', 'submit', array('attr' => array('ng-click' => 'update(post)')))
            ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
        $resolver->setDefaults(array('csrf_protection' => false));
    }

    public function getName()
    {
        return 'contact';
    }
}