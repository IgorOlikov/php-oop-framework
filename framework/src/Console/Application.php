<?php

namespace Framework\Console;

use Psr\Container\ContainerInterface;

class Application
{

    public function __construct(
        private ContainerInterface $container
    )
    {
    }

    public function run(): int
    {
        $argv = $_SERVER['argv'];

        $commandName = $argv[1] ?? null;

        if (!$commandName){
            throw new ConsoleException('Command not exist');
        }

        /** @var CommandInterface $command */
        $command = $this->container->get("console:$commandName");


        $status = $command->execute();



        return $status;
    }

}