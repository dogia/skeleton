<?php

namespace Skeleton\Core\Router;

class Response
{
    private array $headers;
    public function setHeader()
    {

    }

    private function prepare()
    {
        foreach($this->headers as $header)
            header($header);
        return $this;
    }

    public function respondWithStatus(mixed $body, int $status)
    {

    }
}