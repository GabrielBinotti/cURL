<?php

declare(strict_types=1);

namespace Sbintech\cURL\Classes;

use Sbintech\cURL\Interfaces\InterfaceOptionsApplier;

final class CurlRequest
{
    private $options = [];


    public function __construct(string $URL, string $method)
    {
        $this->options[CURLOPT_URL] = $URL;
        $this->options[CURLOPT_CUSTOMREQUEST] = strtoupper(string: $method);
    }

    public function setHeader(InterfaceOptionsApplier $header)
    {
        $header->apply(options: $this->options);
    }

    public function setOptions(InterfaceOptionsApplier $options)
    {
        $options->apply(options: $this->options);
    }

    public function setAuth(InterfaceOptionsApplier $auth)
    {
        $auth->apply(options: $this->options);
    }

    public function setCert(InterfaceOptionsApplier $cert)
    {
        $cert->apply(options: $this->options);
    }

    public function setBody(InterfaceOptionsApplier $body)
    {
        $body->apply(options: $this->options);
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function execute(bool $debug = false, string $type_return = 'object')
    {
        $ch = curl_init();
      
        curl_setopt_array(handle: $ch, options: $this->options);
        
        $response = curl_exec(handle: $ch);
        $error = curl_error(handle: $ch);
        $info = curl_getinfo(handle: $ch);
        curl_close(handle: $ch);

        if ($debug) {
            return [
                'info' => $info,
                'error' => $error,
                'response' => $response,
            ];
        }

        if ($error) {
            throw new \RuntimeException(message: "Error to execute cURL: $error");
        }

        return match ($type_return) {
            'json' => json_decode(json: $response, associative: true),
            'object' => json_decode(json: $response),
            default => $response
        };
    }
}