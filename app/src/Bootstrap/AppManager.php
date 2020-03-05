<?php

namespace App\Bootstrap;

use App\Exceptions\ExceptionManager;
use DI\Bridge\Slim\Bridge;
use DI\Container;
use Slim\App;

class AppManager
{
    /** @var Container The applicaiton container */
    protected $container;

    /**
     * Create a new AppManager object.
     *
     * @param \DI\Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Setup and configure the application.
     *
     * @return \Slim\App
     */
    public function __invoke(): App
    {
        $this->container->call(ProviderManager::class);
        $app = Bridge::create($this->container);
        $this->container->call(MiddlewareManager::class);
        $this->container->call(ExceptionManager::class);

        return $app;
    }
}
