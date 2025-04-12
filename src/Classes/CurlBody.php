<?php

declare(strict_types=1);

namespace Sbintech\cURL\Classes;

use Sbintech\cURL\Interfaces\InterfaceOptionsApplier;

class CurlBody implements InterfaceOptionsApplier
{
    private array|string $body;
    private string $type;

    
    public function __construct(array|string $body, string $type = "json")
    {
        $this->body = $body;
        $this->type = strtolower(string: $type);
    }


    public function getFormattedBody(): mixed
    {
        return match ($this->type) {
            'json' => json_encode(value: $this->body),
            'form' => http_build_query(data: $this->body),
            'multipart' => $this->body,
            'text' => (string) $this->body,
            default => throw new \InvalidArgumentException(message: "Tipo inválido: {$this->type}")
        };
    }


    public function isEmpty(): bool
    {
        return empty($this->body);
    }


    public function apply(array &$options)
    {
        $options[CURLOPT_POSTFIELDS] = $this->getFormattedBody();
    }

}