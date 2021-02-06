<?php

declare(strict_types=1);

namespace gertvdb\LegacyBridgeBundle\Event;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class LegacyKernelBootEvent
 *
 * @package gertvdb\LegacyBridgeBundle\Event
 */
class LegacyKernelBootEvent extends Event
{

    /**
     * The request.
     *
     * @var Request
     */
    protected $request;

    /**
     * The legacy kernel options.
     *
     * @var array<mixed>
     */
    protected $options;

    /**
     * LegacyKernelBootEvent constructor.
     *
     * @param Request $request
     * @param array<mixed> $options
     */
    public function __construct(Request $request, array $options = [])
    {
        $this->request = $request;
        $this->options = $options;

    }

    /**
     * Get the request.
     *
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;

    }

    /**
     * Get options.
     *
     * @return array<mixed>
     */
    public function getOptions(): array
    {
        return $this->options;

    }

    /**
     * Set options.
     *
     * @param array<mixed> $options
     *
     * @return void
     */
    public function setOptions(array $options)
    {
        $this->options = $options;

    }

    /**
     * Set option.
     *
     * @param string $name
     * @param string $value
     *
     * @return void
     */
    public function setOption(string $name, string $value)
    {
        $this->options[$name] = $value;

    }


}
