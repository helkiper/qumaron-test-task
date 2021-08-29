<?php

namespace App\Main;

use App\Action\Action;

class Application
{
    private array $args;

    public function __construct(array $args)
    {
        $this->args = $args;
    }

    public function run()
    {
        $actionName = $this->args[0] ?? '';
        $action = $this->instantiateAction($actionName);

        $action->run(array_slice($this->args, 1));
    }

    private function instantiateAction(string $name): ?Action
    {
        $actionNamespace = Configuration::ACTION_NAMESPACE;
        $actionName = $actionNamespace . ucfirst($name) . 'Action';

        if (class_exists($actionName)) {
            $action = new $actionName();
            if (! $action instanceof Action) {
                return null;
            }

            return $action;
        }

        return null;
    }
}
