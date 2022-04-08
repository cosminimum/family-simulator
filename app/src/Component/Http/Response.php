<?php

namespace App\Component\Http;

class Response
{
    public const HTTP_OK = 200;
    public const HTTP_BAD_REQUEST = 401;
    public const HTTP_INTERNAL_SERVER_ERROR = 500;

    /** @var int */
    private $httpCode;
    /** @var string */
    private $message;
    /** @var ?array */
    private $data;

    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

    public function setHttpCode(int $httpCode): Response
    {
        $this->httpCode = $httpCode;

        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): Response
    {
        $this->message = $message;

        return $this;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData(?array $data): Response
    {
        $this->data = $data;

        return $this;
    }
}