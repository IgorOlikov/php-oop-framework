<?php

namespace Framework\Controller;


use Framework\Http\Request;
use Framework\Http\Response;
use Psr\Container\ContainerInterface;
use Twig\Environment;

abstract class AbstractController
{
    protected ?ContainerInterface $container = null;
    protected Request $request;

    /**
     * @param Request $request
     */
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;

    }
    public function render(string $view, array $parameters = [], Response $response = null): Response
    {
        /** @var Environment $twig */
        $content = $this->container->get('twig')->render($view, $parameters);


        $response ??= new Response();

        $response->setContent($content);

        return $response;
    }



}