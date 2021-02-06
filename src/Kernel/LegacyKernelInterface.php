<?php

declare(strict_types=1);

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
    public function isBooted(): bool;

    /**
     * Return the directory where the legacy app lives.
     *
     * @return string
     */
    public function getRootDir(): string;

    /**
     * Set the directory where the legacy app lives.
     *
     * @param string $rootDir
     *
     * @return void
     */
    public function setRootDir(string $rootDir);

    /**
     * Set the class loader to use to load the legacy project.
     *
     * @param LegacyClassLoaderInterface $classLoader
     *
     * @return void
     */
    public function setClassLoader(LegacyClassLoaderInterface $classLoader);

    /**
     * Return the name of the kernel.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Set kernel options
     *
     * @param array $options
     *
     * @return void
     */
    public function setOptions(array $options=[]);

}//end interface
