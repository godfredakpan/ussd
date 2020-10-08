<?php

namespace Spatie\Export\Crawler;

use GuzzleHttp\Client;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Promise\FulfilledPromise;
use Illuminate\Http\Request;
use Illuminate\Contracts\Http\Kernel as HttpKernel;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

class LocalClient extends Client
{
    /** @var \Illuminate\Contracts\Http\Kernel */
    protected $kernel;

    /** @var \Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory */
    protected $psrHttpFactory;

    public function __construct()
    {
        parent::__construct();

        $this->kernel = app(HttpKernel::class);

        $psr17Factory = new Psr17Factory();

        $this->psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
    }

    public function sendAsync(RequestInterface $request, array $options = [])
    {
        $response = $this->kernel->handle(
            Request::create((string) $request->getUri())
        );

        $psrResponse = $this->psrHttpFactory->createResponse($response);

        return new FulfilledPromise($psrResponse);
    }
}
