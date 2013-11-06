<?php

namespace Acme\SimpleCMSBundle\Admin;

use Dey\Sonata\AngularAdminBundle\Admin\Admin as BaseAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Description of PostAdmin
 *
 * @author dey
 */
class PostAdmin extends BaseAdmin
{
    public function configureListFields(ListMapper $list) 
    {
        $list->add('title')
                ->add('slug')
                ->add('author')
                ->add('category')
                ->add('created_at', 'datetime')
                ;
    }
    
    public function configureFormFields(FormMapper $form) 
    {
        $form->add('title')
                ->add('slug')
                ->add('author')
                ->add('category')
                ->add('content')
                ->add('tags')
                ;
    }
    
    public function configureShowFields(ShowMapper $filter) 
    {
        $filter->add('title')
                ->add('slug')
                ->add('author')
                ->add('category')
                ->add('content')
                ->add('tags')
                ;
    }
}