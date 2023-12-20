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

    public function test_has_method()
    {
        $container = new Container();

        //$this->expectException(ContainerException::class);

        $container->add('somecode-class', SomecodeClass::class);
        $container->add('no-class', SomecodeClass::class);
        $this->assertTrue($container->has('somecode-class'));
        $this->assertTrue($container->has('no-class'));
    }

    public function test_recursively_autowired()
    {
        $container = new Container();

        $container->add('somecode-class', SomecodeClass::class);

        /** @var SomecodeClass $somecode */
        $somecode = $container->get('somecode-class');
        $areaweb = $somecode->getAreaWeb();

        $this->assertInstanceOf(AreaWeb::class, $somecode->getAreaWeb());
        $this->assertInstanceOf(Yotube::class, $areaweb->getYotube());
        $this->assertInstanceOf(Telegram::class, $areaweb->getTelegram());
    }

}