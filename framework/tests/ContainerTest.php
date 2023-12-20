<?php

namespace Framework\Tests;

use Framework\Container\Container;
use Framework\Container\Exceptions\ContainerException;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{
    //lando php vendor/bin/phpunit tests --color
    public function test_getting_service_from_container()
    {
        $container = new Container();

        $container->add('somecode-class', SomecodeClass::class);

        $this->assertInstanceOf(SomecodeClass::class,$container->get('somecode-class'));
    }

    public function test_container_has_wrong_service_exception()
    {
        $container = new Container();

        $this->expectException(ContainerException::class);

        $container->add('no-class');


    }

}