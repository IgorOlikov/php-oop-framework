<?php

namespace Framework\Routing;

use Framework\Http\Request;

interface RouterInterface
{
        public function dispatch(Request $request);



        public function registerRoutes(array $routes): void;
}