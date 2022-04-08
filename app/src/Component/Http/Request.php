<?php

namespace App\Component\Http;

class Request
{
    /** @var array */
    private $parameters;
    /** @var array */
    private $headers;

    public function __construct(array $request)
    {
        $this->parameters = $request;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }
}