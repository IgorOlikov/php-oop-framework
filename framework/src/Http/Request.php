<?php

namespace Framework\Http;

use Framework\Session\SessionInterface;

class Request
{

    private SessionInterface $session;
    private mixed $routeHandler;
    private array $routeArgs;

    public function __construct(
        private readonly array $getParams,
        private readonly array $postData,
        private readonly array $cookies,
        private readonly array $files,
        private readonly array $server,
    )
     {

    }

    public static function createFromGlobals(): static
{
  return new static($_GET,$_POST,$_COOKIE,$_FILES,$_SERVER);
}

    public function getPath(): string
    {
      return strtok($this->server['REQUEST_URI'], token: '?');
    }
    public function getMethod(): string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function getSession(): SessionInterface
    {
        return $this->session;
    }


    public function setSession(SessionInterface $session): void
    {
        $this->session = $session;
    }

    public function input(string $key, mixed $default = null)
    {
        return $this->postData[$key] ?? $default;
    }

    /**
     * @return mixed
     */
    public function getRouteHandler(): mixed
    {
        return $this->routeHandler;
    }

    /**
     * @param mixed $routeHandler
     */
    public function setRouteHandler(mixed $routeHandler): void
    {
        $this->routeHandler = $routeHandler;
    }

    /**
     * @return array
     */
    public function getRouteArgs(): array
    {
        return $this->routeArgs;
    }

    /**
     * @param array $routeArgs
     */
    public function setRouteArgs(array $routeArgs): void
    {
        $this->routeArgs = $routeArgs;
    }




}