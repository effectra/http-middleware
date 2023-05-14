<?php

declare(strict_types=1);

namespace Effectra\Http\Server;

use Effectra\Fs\Path;
use Effectra\Generator\Creator;
use Effectra\Generator\GeneratorClass;

class Generate
{
    public function __construct(
        protected Creator $creator
    ) {
    }

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
            ->withMethod(name: 'process', args: [], return: 'ResponseInterface',content: $content)
            ->withArgument('process', 'ServerRequestInterface', 'request','--')
            ->withArgument('process', 'RequestHandlerInterface', 'handler','--')
            ->withImplements('MiddlewareInterface')
            ->generate()
            ->save($savePath);
    }
}
