<?php



namespace Acme\SimpleCMSBundle\Form\Type;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of AgularChoiceType
 *
 * @author dey
 */
class AngularChoiceTypeExtension extends AbstractTypeExtension
{
    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
        $resolver->setRequired(array(
            'ng-options-property',
            'ng-options-model',
        ));
        $resolver->setOptional(array('ng-model'));
        $resolver->setDefaults(array(
            'options' => array('' => ''),
        ));
    }
    
    public function buildView(FormView $view, FormInterface $form, array $options) 
    {
        
        $view->vars['attr']['ng-options'] = $this->getNgOptions($options);
        $view->vars['attr']['ng-model'] = $this->getNgModel($options);
    }
    
    public function getNgModel(array $options) {
    
        if (isset($options['ng-model'])) {
            return $options['ng-model'];
        }
    
        throw new \Exception('not yet implemented');
    }
    
    public function getNgOptions(array $options)
    {
        if (isset($options['ng-options'])) {
            return $options['ng-options'];
        }
        
        $modelProperty = $this->getNgOptionsModel($options);
        
        $property = $options['ng-options-property'];
        
        return "a.$property for a in $modelProperty";
        
    }
    
    public function getNgOptionsModel(array $options)
    {
        return $options['ng-options-model'];
    }

    public function getName()
    {
        return 'angular_choice';
    }

    public function getExtendedType() 
    {
        return 'choice';
    }
}
