<?php

/*
 * This file is part of the MopaBootstrapBundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mopa\Bundle\BootstrapBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Extension\AbstractExtension;
use Twig\Environment;
use Twig\TwigFunction;

/**
 * Add new twig functions related to forms
 *
 * @author Paweł Madej (nysander) <pawel.madej@profarmaceuta.pl>
 * @author Charles Sanquer <charles.sanquer@gmail.com>
 */
class MopaBootstrapTwigExtension extends AbstractExtension
{
    protected $container;

    protected $environment;

    /**
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     *
     * @param Environment $environment
     */
    public function initRuntime(Environment $environment): void
    {
        $this->environment = $environment;
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions(): array
    {
        return [
            'form_help' => new TwigFunction('Symfony\Bridge\Twig\Node\SearchAndRenderBlockNode', ['is_safe' => ['html']]),
            'form_tabs' => new TwigFunction('Symfony\Bridge\Twig\Node\SearchAndRenderBlockNode', ['is_safe' => ['html']]),
        ];
    }
}
