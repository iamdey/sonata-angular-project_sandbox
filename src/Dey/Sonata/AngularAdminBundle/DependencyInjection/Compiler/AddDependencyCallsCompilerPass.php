<?php

namespace Dey\Sonata\AngularAdminBundle\DependencyInjection\Compiler;

use Sonata\AdminBundle\DependencyInjection\Compiler\AddDependencyCallsCompilerPass as BaseAddDependencyCallsCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Description of AddDependencyCallsCompilerPass
 *
 * @author dey
 */
class AddDependencyCallsCompilerPass extends BaseAddDependencyCallsCompilerPass
{
    public function process(ContainerBuilder $container) 
    {
        foreach ($container->findTaggedServiceIds('sonata.admin') as $id => $tags) {
            $definition = $container->getDefinition($id);
            $arguments = $definition->getArguments();
            $refl = new \ReflectionClass($definition->getClass());
            
            //override default sonata controller if it is not user defined or 
            //the admin class is Angular aware
            if (strlen($arguments[2]) == 0 && $refl->isSubclassOf('\Dey\Sonata\AngularAdminBundle\Admin\Admin')) {
                $definition->replaceArgument(2, 'DeySonataAngularAdminBundle:CRUD');
            }
        }
                
        parent::process($container);
    }
}