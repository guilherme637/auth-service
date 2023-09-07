<?php

namespace App\Domain\VO;

class HashVO
{
    public function __construct(private string $cypher) {}

    public function getHash(): string
    {
        $time = new \DateTime('now');

        return hash('sha256', $this->cypher . $time->format('i:s'));
    }
}