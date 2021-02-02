<?php

namespace gertvdb\LegacyBridgeBundle\EventListener;

use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FinishRequestEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\EventListener\RouterListener as SymfonyRouterListener;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use gertvdb\LegacyBridgeBundle\Kernel\LegacyKernelInterface;

/**
 * RouterListener delegates the request handling to the Symfony router listener.
 * If the later does not match any controller, then this listener catches the NotFoundHttpException
 * and tells the wrapper to handle the request instead.
 */
class RouterListener implements EventSubscriberInterface
{

    /**
     * @var LegacyKernelInterface
     */
    protected $legacyKernel;

    /**
     * @var RouterListener
     */
    protected $routerListener;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param SymfonyRouterListener $routerListener
     * @param LegacyKernelInterface|null $legacyKernel
     * @param LoggerInterface|null $logger
     */
    public function __construct(SymfonyRouterListener $routerListener, LegacyKernelInterface $legacyKernel=NULL, LoggerInterface $logger=NULL)
    {
        $this->legacyKernel   = $legacyKernel;
        $this->routerListener = $routerListener;
        $this->logger         = $logger;

    }//end __construct()

    /**
     * @param RequestEvent $event
     *
     * @return RequestEvent
     * @throws Exception
     */
    public function onKernelRequest(RequestEvent $event)
    {
        try {
            // Try to dispatch the kernel event via symfony 5.
            $this->routerListener->onKernelRequest($event);
        } catch (NotFoundHttpException $e) {
            // Optionally we log the request that go through the legacy controller.
            if ($this->logger !== NULL) {
                $message = 'Request handled by the '.$this->legacyKernel->getName().' kernel.';
                $this->logger->info($message);
            }

            if ($this->legacyKernel !== NULL) {
                // When the request could not be dispatched through symfony 5
                // we fallback to our legacy kernel to dispatch the request.
                $response = $this->legacyKernel->handle(
                    $event->getRequest(),
                    $event->getRequestType(),
                    TRUE
                );

                $event->setResponse($response);
                return $event;
            }
        }//end try

    }//end onKernelRequest()

    /**
     * @param FinishRequestEvent $event
     */
    public function onKernelFinishRequest(FinishRequestEvent $event)
    {
        $this->routerListener->onKernelFinishRequest($event);

    }//end onKernelFinishRequest()

    /**
     * @{inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        $listeners = [
            KernelEvents::REQUEST => [
                [
                    'onKernelRequest',
                    31,
                ],
            ],
        ];

        if (defined('\Symfony\Component\HttpKernel\KernelEvents::FINISH_REQUEST')) {
            $listeners[KernelEvents::FINISH_REQUEST] = [
                [
                    'onKernelFinishRequest',
                    0,
                ],
            ];
        }

        return $listeners;

    }//end getSubscribedEvents()

}//end class
