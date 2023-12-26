<?php

namespace Framework\Http;

use Doctrine\DBAL\Connection;
use Framework\Event\EventDispatcher;
use Framework\Http\Events\ResponseEvent;
use Framework\Http\Exceptions\HttpException;
use Framework\Http\Middleware\RequestHandlerInterface;
use Framework\Routing\RouterInterface;
use League\Container\Container;
use PHPUnit\Logging\Exception;

class Kernel
{
    private string $appEnv = 'local';
    public function __construct(
        private Container $container,
        private RequestHandlerInterface $requestHandler,
        private EventDispatcher $eventDispatcher

    )
    {
        $this->appEnv = $this->container->get('APP_ENV');
    }


    public function handle(Request $request): Response
    {
        try {
            $response = $this->requestHandler->handle($request);
        } catch (\Exception $e) {
            $response = $this->createExceptionResponse($e);
        }

        //$response->setStatusCode(500);

        $this->eventDispatcher->dispatch(new ResponseEvent($request,$response));

        return $response;
    }

    public function terminate(Request $request,Response $response): void
    {
        $request->getSession()?->clearFlash();
    }

    private function createExceptionResponse(\Exception $e)
    {
        if (in_array($this->appEnv,['local','testing'])){
            throw $e;
    }
        if ($e instanceof HttpException){
            return Response($e->getMessage(), $e->getStatusCode());
        }
        return new Response('Server error',500);
    }


}