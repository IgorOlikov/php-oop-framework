<?php

namespace Framework\Http\Events;

use Framework\Http\Request;
use Framework\Http\Response;

class ResponseEvent extends \Framework\Event\Event
{

    public function __construct(
        private readonly Request $request,
        private readonly Response $response,
    )
    {



    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }


}