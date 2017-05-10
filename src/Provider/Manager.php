<?php

namespace Articstudio\IcebergApp\Service\Slim\Provider;

use Slim\Container as SlimContainer;
use Articstudio\IcebergApp\Service\Slim\Exception\Provider\NotFoundException;

class Manager {

    private $providers;

    public function __construct(array $providers = []) {
        $this->providers = $providers;
    }

    public function register(SlimContainer $container) {
        foreach ($this->providers as $provider) {
            $this->registerProvider($container, $provider);
        }
    }

    private function registerProvider(SlimContainer $container, $provider_class_name) {
        if (!is_string($provider_class_name) || !class_exists($provider_class_name)) {
            throw new NotFoundException(sprintf('Slim provider error while retrieving "%s"', $provider_class_name));
        }
        try {
            $provider = new $provider_class_name;
            $container->register($provider);
        } catch (Exception $exception) {
            throw new NotFoundException(sprintf('Slim provider error while retrieving "%s"', $provider_class_name), null, $exception);
        } catch (Throwable $exception) {
            throw new NotFoundException(sprintf('Slim provider error while retrieving "%s"', $provider_class_name), null, $exception);
        }
    }

}
