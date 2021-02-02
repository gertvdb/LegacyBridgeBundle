<?php

namespace gertvdb\LegacyBridgeBundle\Kernel;

use RuntimeException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use gertvdb\LegacyBridgeBundle\Autoload\LegacyClassLoaderInterface;

/**
 * Interface LegacyKernelInterface
 *
 * @package gertvdb\LegacyBridgeBundle\Kernel
 */
interface LegacyKernelInterface extends HttpKernelInterface
{

    /**
     * Boot the legacy kernel.
     *
     * @param  ContainerInterface $container
     *
     * @return mixed
     * @throws RuntimeException
     */
    public function boot(ContainerInterface $container);

    /**
     * Check whether the legacy kernel is already booted or not.
     *
     * @return boolean
     */
    public function isBooted();

    /**
     * Return the directory where the legacy app lives.
     *
     * @return string
     */
    public function getRootDir();

    /**
     * Set the directory where the legacy app lives.
     *
     * @param string $rootDir
     */
    public function setRootDir($rootDir);

    /**
     * Set the class loader to use to load the legacy project.
     *
     * @param LegacyClassLoaderInterface $classLoader
     */
    public function setClassLoader(LegacyClassLoaderInterface $classLoader);

    /**
     * Return the name of the kernel.
     *
     * @return string
     */
    public function getName();

    /**
     * Set kernel options
     *
     * @param array $options
     */
    public function setOptions(array $options=[]);

}//end interface
