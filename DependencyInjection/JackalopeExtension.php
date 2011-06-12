<?php

namespace Jackalope\Bundle\JackalopeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/*new Reference('doctrine.dbal' . $connection . '_connection);
instead of the jcakrabbit trasnport,
it should inject a doctrine transport
and re-use a doctrine connection for it
in the dependency injection configuraiton
then you can construct "jackalope" service to be created with a
Jackalope\Transport\Doctrine\DoctrineTransport*/

class JackalopeExtension extends Extension
{
    /**
     * Loads the Jackalope configuration.
     *
     * @param array $config An array of configuration settings
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->process($configuration->getConfigTree(),$configs);

        $options = array();
        foreach (array('connection', 'user', 'pass', 'workspace', 'transport') as $var) {
            $options[$var] = $config[$var];
            $container->setParameter('jackalope.options.'.$var, $config[$var]);
        }

        $loader = new XmlFileLoader($container,  new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('jackalope.xml');

        $container->setAlias('jackalope.transport', 'jackalope.transport.'.$config['transport']);

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
