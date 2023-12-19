<?php

namespace Framework\Http;

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use Framework\Http\Response;
class Kernel
{

   public function handle(Request $request): Response
   {
       $dispatcher  = simpleDispatcher(function (RouteCollector $collector){
             $routes = include BASE_PATH.'/routes/web.php';
            //dd($routes);
            foreach ($routes as $route){
                $collector->addRoute(...$route);
            }

          //$collector->get('/', function() {
          //     $content = 'HELLO WORLD3 HTML1111';
          //     return new Response($content);
          // });
          //$collector->get('/posts/{id:\d+}', function (array $vars){
          //    $content = "POST - {$vars['id']}";
          //    return new Response($content);
          // });
        });

       //dd($request->getPath());


      $routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());

      [$status,[$controller,$method],$vars] = $routeInfo;

      $response = call_user_func_array([new $controller,$method],$vars);

      return $response;

   }

}