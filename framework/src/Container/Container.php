<?php

namespace Framework\Container;

use Framework\Container\Exceptions\ContainerException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private array $services = [];
    public function add(string $id,string|object $concrete = null)
    {
        if (is_null($concrete)){
            if(!class_exists($id)) {
                throw new ContainerException("Service with id $id not found");
            }
            $concrete = $id;
        }

        $this->services[$id] = $concrete;
    }

    public function get(string $id)
    {
        if (!$this->has($id)) {
            if(!class_exists($id)) {
                throw new ContainerException("Service with id $id could not be resolved");
            }
                $this->add($id);
        }
        $instance = $this->resolve($this->services[$id]);

        return $instance;
    }

    /**
     * @throws \ReflectionException
     */
    private function resolve($class)
    {
      $reflectionClass = new \ReflectionClass($class);

      $constructor = $reflectionClass->getConstructor();

      if (is_null($constructor)){
          return $reflectionClass->newInstance();
      }
         $constructorParams = $constructor->getParameters();

        // array:1 [
        //  0 => ReflectionParameter {#18
        //    +name: "areaWeb"
        //    position: 0
        //    typeHint: "Framework\Tests\AreaWeb"
        //  }
        //]

        $classDependencies = $this->resolveClassDependencies($constructorParams);

        $instance = $reflectionClass->newInstanceArgs($classDependencies);

        dd($instance);
        return $instance;
    }
    private function resolveClassDependencies(array $constructorParams)
    {
        $classDependencies = [];

        /** @var \ReflectionParameter $constructorParam */
        foreach ($constructorParams as $constructorParam){
            $serviceType = $constructorParam->getType();
            $service = $this->get($serviceType->getName());//Recursion dependencies services search and ADD to service array->(Class_Namespace) Framework\Tests\AreaWeb^ {#461}
            $classDependencies[] = $service;
        }
          return $classDependencies;
    }


    public function has(string $id): bool
    {
       return array_key_exists($id,$this->services);
    }



}