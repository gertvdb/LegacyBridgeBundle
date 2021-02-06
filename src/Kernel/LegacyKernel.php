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
     * @var array<mixed>
     */
    protected $options;

    /**
     * {@inheritdoc}
     */
    public function isBooted(): bool
    {
        return $this->isBooted;

    }

    /**
     * {@inheritdoc}
     */
    public function getRootDir(): string
    {
        return $this->rootDir;

    }

    /**
     * {@inheritdoc}
     */
    public function setRootDir(string $rootDir)
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
