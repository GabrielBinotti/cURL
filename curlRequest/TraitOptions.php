<?php
namespace GabrielBinottiCurl;

trait TraitOptions
{
    public function options($arrayOptions = [])
    {
        if(empty($arrayOptions)){
            $this->options = [
                CURLOPT_RETURNTRANSFER      => true,
                CURLOPT_ENCODING            => '',
                CURLOPT_MAXREDIRS           => 10,
                CURLOPT_TIMEOUT             => 30,
                CURLOPT_FOLLOWLOCATION      => true,
                CURLOPT_HTTP_VERSION        => CURL_HTTP_VERSION_1_1,
                ];
        }else{
            $this->options = $arrayOptions;
        }
        return $this;
    }

    public function applyOptions($curl)
    {
        curl_setopt_array($curl, $this->options);
    }
}