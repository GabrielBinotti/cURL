<?php

namespace GabrielBinottiCurl;


class MyCurl implements InterfaceOptions, InterfaceHeader
{
    use TraitOptions;
    use TraitBody;
    use TraitAuth;
    use TraitHeader;

    private $url;
    private $method;
    private $options;
    private $body;
    private $typeAuth;
    private $passAuth;
    private $header;
  

    public function url($url)
    {
        $this->url = $url;
        return $this;
    }

    public function method($method = 'POST')
    {
        $this->method = $method;
        return $this;
    }

    public function execute($return = null)
    {
        $curl = curl_init($this->url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $this->method);

        $this->applyOptions($curl); // requerido
        $this->applyBody($curl);
        $this->applyAuth($curl);
        $this->applyHeader($curl); // requerido

        if ($return == 'object') {

            $response = json_decode(curl_exec($curl));
        } else if ($return == 'array') {

            $response = json_decode(curl_exec($curl), true);
        } else {

            $response = curl_exec($curl);
        }
        return $response;
    }
}
