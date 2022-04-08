<?php

namespace App\Component\Database;

class Result
{
    /** @var ?array */
    private $data;

    public function __construct(?array $data)
    {
        $this->data = $data;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function count(): int
    {
        return count($this->data);
    }
}