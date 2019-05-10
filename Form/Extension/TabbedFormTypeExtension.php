<?php

namespace Mopa\Bundle\BootstrapBundle\Form\Extension;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormFactoryInterface;
use Mopa\Bundle\BootstrapBundle\Form\Type\TabsType;

class TabbedFormTypeExtension extends AbstractTypeExtension
{
    private $formFactory;
    private $options;

    public function __construct(FormFactoryInterface $formFactory, array $options)
    {
        $this->formFactory = $formFactory;
        $this->options = $options;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return FormType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'tabs_class' => $this->options['class'],
        ]);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['tabbed'] = false;
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        if ( ! $view->vars['tabbed']) {
            return;
        }

        $found_first = false;
        $tabs = [];

        foreach ($view->children as $child) {
            if (in_array('tab', $child->vars['block_prefixes'])) {
                if ( ! $found_first) {
                    $child->vars['tab_active'] = $found_first = true;
                }

                $tabs[] = [
                    'id'    => $child->vars['id'],
                    'label' => $child->vars['label'],
                    'icon'  => $child->vars['icon'],
                ];
            }
        }

        $tabsForm = $this->formFactory->create(TabsType::class, null, [
            'tabs' => $tabs,
            'attr' => [
                'class' => $options['tabs_class'],
            ],
        ]);

        $view->vars['tabs'] = $tabs;
        $view->vars['tabbed'] = true;
        $view->vars['tabsView'] = $tabsForm->createView();
    }
}
