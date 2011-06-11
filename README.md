JackalopeBundle
===============

Provides basic integration of the Jackalope library into Symfony projects
Supports doctrine transport

Installation
============

 1. Add the JackalopeBundle and the jackalope library to your project as git submodules:

        $ git submodule add git://github.com/jackalope/JackalopeBundle.git vendor/bundles/JackalopeBundle
        $ git submodule add git://github.com/jackalope/jackalope.git vendor/jackalope
        $ git submodule update --recursive --init

 2. Add the bundle to your application kernel:

        // app/AppKernel.php
        public function registerBundles()
        {
            return array(
                // ...
                new Jackalope\Bundle\JackalopeBundle\JackalopeBundle(),
                // ...
            );
        }

 3. Add the autoloader namespace paths:

        // src/autoload.php
        $loader->registerNamespaces(array(
            // ...
            'JackalopeBundle'                => __DIR__.'/../vendor/bundles',
            'Jackalope'                      => __DIR__.'/../vendor/jackalope/src',
            'PHPCR'                          => __DIR__.'/../vendor/jackalope/lib/phpcr/src',
            // ...
        ));

 4. Add the bundle to your application config:

        # This configuration is to support doctrine transport
        # app/config/config.yml
        jackalope:
           transport: doctrine
           connection: default
           workspace: default
           user: default
           pass: default

        # app/config/config.yml
        jackalope.config:
            url: http://localhost:8080/server/
            workspace: foo
            user:
            pass:
            transport:

        # app/config/config.xml
        <jackalope:config
            url="http://localhost:8080/server/"
            workspace="foo"
            user=""
            pass=""
            transport=""
        />

Usage
=====

Call getSession() on the jackalope service to get a Jackalope\Session instance, then you can follow the jackalope docs, e.g.:

    $this->container->get('jackalope')->getSession()->getNode('/')


Contributors
============

- Jordi Boggiano <j.boggiano@seld.be>
- Luis Cordova <cordoval@gmail.com>
