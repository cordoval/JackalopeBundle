JackalopeBundle
===============

Provides basic integration of the Jackalope library into Symfony projects

Installation
============

 1. Add the JackalopeBundle and the jackalope library to your project as git submodules:

        $ git submodule add git://github.com/jackalope/JackalopeBundle.git src/Bundle/JackalopeBundle
        $ git submodule add git://github.com/jackalope/jackalope.git src/vendor/jackalope
        $ git submodule update --recursive --init

 2. Add the bundle to your application kernel:

        // app/AppKernel.php
        public function registerBundles()
        {
            return array(
                // ...
                new Bundle\JackalopeBundle\JackalopeBundle(),
                // ...
            );
        }

 3. Add the autoloader namespace paths:

        // src/autoload.php
        $loader->registerNamespaces(array(
            // ...
            'Jackalope'                      => $vendorDir.'/jackalope/src',
            'PHPCR'                          => $vendorDir.'/jackalope/lib/phpcr/src',
            // ...
        ));

 4. Add the bundle to your application config:

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
