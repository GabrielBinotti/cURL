<?php

declare(strict_types=1);

namespace Sbintech\cURL\Classes;

use Sbintech\cURL\Interfaces\InterfaceOptionsApplier;

class CurlHeader implements InterfaceOptionsApplier
{
    private array $header = [];
    private bool $useDefaultHeaders = true;


    public function __construct()
    {
        $this->header["Content-Type"]   = "application/json"; 
        $this->header["Accept"]         = "application/json"; 
    }


    public function add(string $key, string $value): self
    {
        if ($this->useDefaultHeaders) {
            $this->header = []; 
            $this->useDefaultHeaders = false;
        }

        $this->header[$key] = $value;
        return $this;
    }


    public function addAuth(string $key, string $value)
    {
        $this->header[$key] = $value;
    }


    public function getFormattedHeader(): array
    {
        $formatted = [];
        foreach ($this->header as $key => $value) {
            $formatted[] = "{$key}: {$value}";
        }
        return $formatted;
    }

    
    public function apply(array &$options)
    {
        $options[CURLOPT_HTTPHEADER] = $this->getFormattedHeader();
    }

}