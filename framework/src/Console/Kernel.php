<?php

namespace Framework\Console;

use Psr\Container\ContainerInterface;

class Kernel
{
    public function __construct(private  ContainerInterface $container)
    {
    }

    public function handle(): int
    {
        $this->registerCommands();

        return 0;
    }

    private function registerCommands():void
    {

        $commandFiles = new \DirectoryIterator(__DIR__.'/Commands');
        $namespace = $this->container->get('framework-commands-namespace');

        foreach ($commandFiles as $commandFile){
            if(!$commandFile->isFile()){
                continue;
            }

            $command = $namespace . pathinfo($commandFile,PATHINFO_FILENAME);
            if (is_subclass_of($command,CommandInterface::class)){
                $name = (new \ReflectionClass($command))
                    ->getProperty('name')->getDefaultValue();


               $this->container->add("console:$name",$command);
            }

            }
            dd($this->container);
        }
    }

