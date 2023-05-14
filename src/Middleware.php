<?php

declare(strict_types=1);

namespace Effectra\Http\Server;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
/**
 * Class Middleware
 *
 * This class serves as a base middleware implementation that implements the MiddlewareInterface.
 * It provides a default implementation of the process method.
 *
 * @package Effectra\Http\Server
 */
class Middleware implements MiddlewareInterface
{
    protected $middlewares = [];
    /**
     * Process the server request and return the response.
     *
     * @param ServerRequestInterface $request The server request to be processed.
     * @param RequestHandlerInterface $handler The request handler to delegate the request to.
     * @return ResponseInterface The processed response.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);

        return $response;
    }
}
