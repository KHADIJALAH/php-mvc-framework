<?php

namespace app\Core;

class Response
{
    public function setStatusCode(int $code): void
    {
        http_response_code($code);
    }

    public function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }

    public function json(array $data, int $statusCode = 200): string
    {
        $this->setStatusCode($statusCode);
        header('Content-Type: application/json');
        return json_encode($data);
    }
}
