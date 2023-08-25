<?php

namespace App\Domain\Adapter\HTMLPurify;

class HtmlPurifyAdapter
{
    private \HTMLPurifier $purifier;

    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        $config = \HTMLPurifier_Config::createDefault();
        $config->set('Core.Encoding', 'ISO-8859-1');
        $config->set('HTML.Doctype', 'HTML 4.01 Transitional');

         $this->purifier = new \HTMLPurifier($config);
    }

    public function purifyFromArray(array $data): array
    {
        return $this->purifier->purifyArray($data);
    }
}