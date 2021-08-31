<?php

namespace App\Main;

use App\Action\Action;
use App\DependencyInjection\Container;
use ReflectionException;

class Application
{
    /**
     * @var array
     */
    private array $args;

    /**
     * @param array $args
     */
    public function __construct(array $args)
    {
        $this->args = $args;
    }

    /**
     * @throws ReflectionException
     */
    public function run()
    {
        Container::init();

        $actionName = $this->args[0] ?? '';
        $action = $this->instantiateAction($actionName);

        $action->run(array_slice($this->args, 1));
    }

    /**
     * @param string $name
     * @return Action|null
     * @throws ReflectionException
     */
    private function instantiateAction(string $name): ?Action
    {
        $actionNamespace = Configuration::ACTION_NAMESPACE;
        $actionName = $actionNamespace . ucfirst($name) . 'Action';

        $action = Container::get($actionName);

        return $action instanceof Action ? $action : null;

    }
}
