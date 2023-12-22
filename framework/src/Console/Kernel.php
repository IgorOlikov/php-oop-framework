<?php

namespace Framework\Console;

class Kernel
{
    public function handle(): int
    {
        dd('Hello, console');

        return 0;
    }

}