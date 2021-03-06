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
     * @throws todo.. findout which exceptions might be thrown.
     */
    public function initPath($path)
    {
        $node = $this->getSession()->getRootNode();
        $nodes = explode('/', $path);

        // remove first entry if empty.
        if (empty($nodes[0])) {
            array_shift($nodes);
        }
        foreach($nodes as $subpath) {
            $node = $node->addNode($subpath);
        }
        return $node;
    }

}
