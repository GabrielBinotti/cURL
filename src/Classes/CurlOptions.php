<?php

declare(strict_types=1);

namespace Sbintech\cURL\Classes;

use Sbintech\cURL\Interfaces\InterfaceOptionsApplier;

class CurlOptions implements InterfaceOptionsApplier
{
    private array $op = [];
    private bool $useDefaultOptions = true;

    public function __construct()
    {
     
        $this->op[CURLOPT_RETURNTRANSFER] = true; 
        $this->op[CURLOPT_ENCODING] = '';
        $this->op[CURLOPT_MAXREDIRS] = 10;
        $this->op[CURLOPT_TIMEOUT] = 30;
        $this->op[CURLOPT_FOLLOWLOCATION] = true; 
        $this->op[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_1;
    
    }

    public function add(int $option, mixed $value): self
    {
        if ($this->useDefaultOptions) {
            $this->op = [];
            $this->useDefaultOptions = false;
        }

        $this->op[$option] = $value;
        return $this;
    }

    public function apply(array &$options)
    {
        foreach ($this->op as $option => $value) {
            $options[$option] = $value;
        }
    }
}


