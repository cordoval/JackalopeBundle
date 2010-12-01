<?php

namespace Bundle\JackalopeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class JackalopeExtension extends Extension
{
    /**
     * Loads the Jackalope configuration.
     *
     * @param array $config An array of configuration settings
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    public function configLoad($config, ContainerBuilder $container)
    {
        if (!$container->hasDefinition('jackalope.loader')) {
            $loader = new XmlFileLoader($container, __DIR__.'/../Resources/config');
            $loader->load('jackalope.xml');
        }

        if (!isset($config['workspace'])) {
            throw new \Exception('Jackalope\'s workspace parameter is mandatory');
        }

        $options = array();
        foreach (array('url', 'user', 'pass', 'workspace', 'transport') as $var) {
            if (isset($config[$var])) {
                $options[$var] = $config[$var];
                $container->setParameter('jackalope.options.'.$var, $config[$var]);
            }
        }
        $container->setParameter('jackalope.options', array_replace($container->getParameter('jackalope.options'), $options));
    }

    /**
     * Returns the base path for the XSD files.
     *
     * @return string The XSD base path
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    public function getNamespace()
    {
        return 'http://www.symfony-project.org/schema/dic/jackalope';
    }

    public function getAlias()
    {
        return 'jackalope';
    }
}
