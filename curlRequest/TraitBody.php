<?php
namespace GabrielBinottiCurl;

trait TraitBody
{

    public function body($body = [])
    {
        if(!empty($body)){
            $this->body = $body;
        }

        return $this;
    }

    public function applyBody($curl)
    {
        $json = json_encode($this->body);
        
        if(!empty($this->body)){
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        }
    }
}