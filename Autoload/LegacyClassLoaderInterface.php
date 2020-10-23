<?php
/**
 *
 */
namespace Tactics\LegacyBridgeBundle\Autoload;

use Tactics\LegacyBridgeBundle\Kernel\LegacyKernelInterface;

/**
 * LegacyClassLoaderInterface
 */
interface LegacyClassLoaderInterface
{

    /**
     * Autoload the legacy code.
     *
     * @return void
     */
    public function autoload();

    /**
     * Check whether the legacy is already autoloaded.
     *
     * @return bool
     */
    public function isAutoloaded();

    /**
     * Inject the kernel into the class loader.
     *
     * @param LegacyKernelInterface $kernel
     */
    public function setKernel(LegacyKernelInterface $kernel);

}
