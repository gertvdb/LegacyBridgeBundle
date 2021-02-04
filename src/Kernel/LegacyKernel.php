<?php

declare(strict_types=1);

namespace gertvdb\LegacyBridgeBundle\Kernel;

use gertvdb\LegacyBridgeBundle\Autoload\LegacyClassLoaderInterface;

/**
 * LegacyKernel
 */
abstract class LegacyKernel implements LegacyKernelInterface
{

    /**
     * @var bool
     */
    protected $isBooted = FALSE;

    /**
     * @var string
     */
    protected $rootDir;

    /**
     * @var LegacyClassLoaderInterface
     */
    protected $classLoader;

    /**
     * @var array
     */
    protected $options;

    /**
     * {@inheritdoc}
     */
    public function isBooted()
    {
        return $this->isBooted;

    }

    /**
     * {@inheritdoc}
     */
    public function getRootDir()
    {
        return $this->rootDir;

    }

    /**
     * {@inheritdoc}
     */
    public function setRootDir($rootDir)
    {
        $this->rootDir = $rootDir;

    }

    /**
     * {@inheritdoc}
     */
    public function setClassLoader(LegacyClassLoaderInterface $classLoader)
    {
        $classLoader->setKernel($this);
        $this->classLoader = $classLoader;

    }

    /**
     * {@inheritdoc}
     */
    public function setOptions(array $options = array())
    {
        $this->options = $options;

    }

}
