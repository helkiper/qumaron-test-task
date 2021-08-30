<?php

namespace App\DependencyInjection;

use LogicException;

class Container
{
    private static $classMap = [];

    public static function get(string $className): object
    {
        if (isset(self::$classMap[$className])) {
            return self::$classMap[$className];
        }
        if (!array_key_exists($className, self::$classMap)) {
            throw new LogicException(sprintf('Class %s does not exist', $className));
        }

        $refClass = new \ReflectionClass($className);
        $constructor = $refClass->getConstructor();
        if (is_null($constructor) || empty($constructorParams = $constructor->getParameters())) {
            $instance = new $className();
            self::$classMap[$className] = $instance;

            return $instance;
        }

        $actualParams = [];
        foreach ($constructorParams as $param) {
            $actualParams[$param->getName()] = $param->isDefaultValueAvailable() ?
                $param->getDefaultValue() :
                self::get($param->getClass()->getName());
        }

        $instance = null;
        eval(sprintf('$instance = new %s($actualParams[%s]);',
            $className,
            implode('], $actualParams[', array_keys($actualParams))
        ));
        self::$classMap[$className] = $instance;

        return  $instance;
    }

    public static function init()
    {
        self::registerClassesInDir(dirname(__DIR__), "App\\");
    }

    public static function getInstancesOf(string $parentClassName): array
    {
        $result = [];

        foreach (array_keys(self::$classMap) as $class) {
            if (is_subclass_of($class, $parentClassName) || in_array($parentClassName, class_implements($class))) {
                $result[] = self::get($class);
            }
        }

        return $result;
    }

    private static function registerClassesInDir(string $dir, string $namespace)
    {
        foreach (scandir($dir) as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }

            if (is_dir($dir . '/' . $file)) {
                self::registerClassesInDir($dir . '/' . $file, $namespace . $file . '\\');
            } elseif (strpos($file, '.php')) {
                $className = $namespace . str_replace('.php', '', $file);
                if (class_exists($className) && !isset(self::$classMap[$className])) {
                    self::$classMap[$className] = null;
                }
            }
        }
    }
}
