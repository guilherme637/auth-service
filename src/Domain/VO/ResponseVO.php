<?php

namespace App\Domain\VO;

use App\Domain\Enum\CodeEnum;

class ResponseVO
{
    private array $response;

    public function __construct(\Throwable $throwable)
    {
        $this->response = [
            'error' => $throwable->getMessage(),
//            'error_description' =>
        ];
    }

    public function getMessage(): string
    {
        return $this->response['message'];
    }

    public function getCode(): int
    {
        return $this->response['code'];
    }

    public function getResponse(): array
    {
        return $this->response;
    }
}