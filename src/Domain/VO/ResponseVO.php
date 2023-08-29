<?php

namespace App\Domain\VO;

class ResponseVO
{
    private string $message;
    private int $code;
    private array $response;

    public function __construct(\Throwable $throwable)
    {
        $this->message = $throwable->getMessage();
        $this->code = $throwable->getCode();
        $this->response = [
            'error' => $throwable->getMessage(),
//            'error_description' =>
        ];
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getResponse(): array
    {
        return $this->response;
    }
}