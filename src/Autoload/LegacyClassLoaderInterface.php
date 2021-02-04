<?php

declare(strict_types=1);

namespace gertvdb\LegacyBridgeBundle\Autoload;

use gertvdb\LegacyBridgeBundle\Kernel\LegacyKernelInterface;

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
     * Check whether the legacy kernel is already auto loaded.
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
