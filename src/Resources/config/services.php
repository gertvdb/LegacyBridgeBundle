<?php

declare(strict_types=1);

use gertvdb\LegacyBridgeBundle\Configuration\Option;
use gertvdb\LegacyBridgeBundle\EventListener\BridgeRouterListener;
use gertvdb\LegacyBridgeBundle\EventListener\LegacyBooterListener;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

/**
 * Container configurator
 * @param ContainerConfigurator $containerConfigurator
 */
return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::OPTION_ROUTE_LISTENER_CLASS, BridgeRouterListener::class);
    $parameters->set(Option::OPTION_BOOTER_LISTENER_CLASS, LegacyBooterListener::class);

    $services = $containerConfigurator->services();

    $services->set('legacy_bridge_bundle.router_listener', '%legacy_bridge_bundle.router_listener.class%')
        ->tag('kernel.event_subscriber', [])
        ->tag('monolog.logger', ['channel' => 'event'])
        ->autowire()
        ->args([
            service('router_listener'),
            service('legacy_bridge_bundle.legacy_kernel'),
            service('logger')->nullOnInvalid()
        ]);

    $services->set('legacy_bridge_bundle.legacy_booter_listener', '%legacy_bridge_bundle.legacy_booter_listener.class%')
        ->tag('kernel.event_subscriber', [])
        ->autowire()
        ->args([
            service('legacy_bridge_bundle.legacy_kernel'),
            service('service_container')
        ]);
};
