<?php

namespace Framework\Controller;


use Framework\Http\Response;
use Psr\Container\ContainerInterface;
use Twig\Environment;

abstract class AbstractController
{
    protected ?ContainerInterface $container = null;

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