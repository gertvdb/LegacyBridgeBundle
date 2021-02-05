<?php

declare(strict_types=1);

namespace gertvdb\LegacyBridgeBundle\Configuration;

final class Option
{

    /**
     * @var string
     */
    public const OPTION_ROUTE_LISTENER_CLASS = 'legacy_bridge_bundle.router_listener.class';

    /**
     * @var string
     */
    public const OPTION_BOOTER_LISTENER_CLASS = 'legacy_bridge_bundle.legacy_booter_listener.class';

    /**
     * @var string
     */
    public const OPTION_LEGACY_KERNEL_ID = 'legacy_bridge_bundle.legacy_kernel.id';

    /**
     * @var string
     */
    public const OPTION_LEGACY_KERNEL_CLASS_LOADER_ID = 'legacy_bridge_bundle.legacy_kernel.class_loader.id';

    /**
     * @var string
     */
    public const OPTION_LEGACY_KERNEL_OPTIONS = 'legacy_bridge_bundle.legacy_kernel.options';



}
