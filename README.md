# Effectra Middleware

The `effectra/http-server-middleware` library provides middleware classes for handling HTTP requests and responses in server applications.

## Installation

Install the library using Composer:

```bash
composer require effectra/http-middleware
```

## Usage

### Middleware Class

The `Effectra\Http\Server\Middleware` class is a base middleware class that implements the `MiddlewareInterface`. It provides a `process` method for processing the server request and returning the response.

```php
use Effectra\Http\Server\Middleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MyMiddleware extends Middleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // Perform middleware logic here

        $response = $handler->handle($request);

        // Perform additional middleware logic here

        return $response;
    }
}
```

## Contributing

Contributions are welcome! Please feel free to submit bug reports, feature requests, or pull requests.

## License

This library is licensed under the [MIT License](LICENSE).

Feel free to customize and enhance the README file to better suit your project's needs.
