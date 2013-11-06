<?php

namespace Dey\Sonata\AngularAdminBundle;

use Dey\Sonata\AngularAdminBundle\DependencyInjection\Compiler\AddDependencyCallsCompilerPass;
use Sonata\AdminBundle\DependencyInjection\Compiler\AddFilterTypeCompilerPass;
use Sonata\AdminBundle\DependencyInjection\Compiler\ExtensionCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DeySonataAngularAdminBundle extends Bundle
{
    public function getParent() 
    {
        return 'SonataAdminBundle';
    }
    
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new AddDependencyCallsCompilerPass());
        $container->addCompilerPass(new AddFilterTypeCompilerPass());
        $container->addCompilerPass(new ExtensionCompilerPass());
    }
}
