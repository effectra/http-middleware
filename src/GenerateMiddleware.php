<?php

declare(strict_types=1);

namespace Effectra\Http\Server;

use Effectra\Fs\Path;
use Effectra\Generator\Creator;
use Effectra\Generator\GeneratorClass;

/**
 * Class GenerateMiddleware
 *
 * This class provides functionality to generate middleware classes based on the Middleware base class.
 *
 * @package Effectra\Http\Server
 */
class GenerateMiddleware
{
    /**
     * Generate constructor.
     *
     * @param Creator $creator The creator instance used for generating the middleware class.
     */

    public function __construct(
        protected Creator $creator
    ) {
    }
    /**
     * Generates a new middleware class and saves it to the specified path.
     *
     * @param string $path The path where the middleware class file should be saved.
     * @param string $name The name of the middleware class to be generated.
     * @return void
     */
    public function baseMiddleware(string $path, string $name)
    {
        if (!str_contains('Middleware', $name)) {
            $name = trim($name) . 'Middleware';
        }
        $savePath = Path::format(rtrim($path, Path::ds()) . Path::ds() . $name) . '.php';

        $content = '
            $response = $handler->handle($request);

            return $response;
        ';

        $cls = new GeneratorClass($this->creator, $name);
        $cls
            ->withExtends('Middleware')
            ->withPackages([
                'Effectra\Http\Server\Middleware',
                'Psr\Http\Message\ResponseInterface',
                'Psr\Http\Message\ServerRequestInterface',
                'Psr\Http\Server\MiddlewareInterface',
                'Psr\Http\Server\RequestHandlerInterface'
            ])
            ->withMethod(name: 'process', args: [], return: 'ResponseInterface', content: $content)
            ->withArgument('process', 'ServerRequestInterface', 'request', '--')
            ->withArgument('process', 'RequestHandlerInterface', 'handler', '--')
            ->withImplements('MiddlewareInterface')
            ->generate()
            ->save($savePath);
    }
}
