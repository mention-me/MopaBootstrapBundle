<?php

namespace Mopa\Bundle\BootstrapBundle\Form\Extension;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class ErrorTypeFormTypeExtension extends AbstractTypeExtension
{
    protected $error_type;

    public function __construct(array $options)
    {
        $this->error_type = $options['error_type'];
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['error_type'] = $options['error_type'];
        $view->vars['error_delay'] = $options['error_delay'];
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'error_type'  => $this->error_type,
            'error_delay' => false,
        ]);
    }

    public function getExtendedType()
    {
        return 'form';
    }
}
