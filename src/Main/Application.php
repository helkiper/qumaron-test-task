<?php

namespace App\Main;

use App\Action\Action;
use App\DependencyInjection\Container;

class Application
{
    private array $args;

    public function __construct(array $args)
    {
        $this->args = $args;
    }

    public function run()
    {
        Container::init();

        $actionName = $this->args[0] ?? '';
        $action = $this->instantiateAction($actionName);

        $action->run(array_slice($this->args, 1));
    }

    private function instantiateAction(string $name): ?Action
    {
        $actionNamespace = Configuration::ACTION_NAMESPACE;
        $actionName = $actionNamespace . ucfirst($name) . 'Action';

        $action = Container::get($actionName);

        return $action instanceof Action ? $action : null;

    }
}
