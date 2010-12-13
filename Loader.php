<?php

namespace Bundle\JackalopeBundle;

class Loader
{
    protected $repository;
    protected $session;

    protected $config;

    public function __construct($repository, $config)
    {
        $this->repository = $repository;
        $this->config = $config;
    }

    public function getSession()
    {
        if (!$this->session) {
            $this->session = $this->login();
        }
        return $this->session;
    }

    public function login(array $config = array())
    {
        $config = array_merge($this->config, $config);
        $credentials = new \PHPCR\SimpleCredentials($config['user'], $config['pass']);
        return $this->repository->login($credentials, $config['workspace']);
    }

    /**
     * Setup the base structure for this importer if necessary.
     *
     * @return \PHPCR\NodeInterface
     * @throws a bloody lot of exceptions ... todo!!
     */
    protected function initPath($path)
    {
        $jackalopeSession = $this->getJackalopeSession();
        $node = $jackalopeSession->getRootNode();
        $nodes = explode('/', $path);
        foreach($nodes as $subpath) {
            $node = $node->addNode($subpath);
        }
        return $node;
    }

}
