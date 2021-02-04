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

}
