<?php

namespace gertvdb\LegacyBridgeBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use gertvdb\LegacyBridgeBundle\Kernel\LegacyKernelInterface;

/**
 * Class LegacyBooterListener
 *
 * On every request we check if the legacy kernel is booted
 * and else we boot it and pass it the container.
 * The only downside here is that we boot symfony 2 times.
 *
 * @package gertvdb\LegacyBridgeBundle\EventListener
 */
class LegacyBooterListener implements EventSubscriberInterface
{

    /**
     * The legacy kernel.
     *
     * @var LegacyKernelInterface
     */
    private $kernel;

    /**
     * The container.
     *
     * @var ContainerInterface
     */
    private $container;

    /**
     * LegacyBooterListener constructor.
     *
     * @param LegacyKernelInterface $kernel    The legacy kernel.
     * @param ContainerInterface    $container The container.
     */
    public function __construct(
        LegacyKernelInterface $kernel,
        ContainerInterface $container
    )
    {
        $this->kernel    = $kernel;
        $this->container = $container;

    }//end __construct()

    /**
     * On kernel request
     *
     * Make sure the legacy kernel is booted with the container
     * on every request.
     *
     * @param RequestEvent $event The request
     *
     * @return void
     */
    public function onKernelRequest(RequestEvent $event)
    {
        if ($this->kernel->isBooted() === FALSE) {
            $this->kernel->boot($this->container);
        }

    }//end onKernelRequest()

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [
                'onKernelRequest',
                '35',
            ],
        ];

    }//end getSubscribedEvents()


}//end class
