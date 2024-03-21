<?php

namespace GabrielBinottiCurl;

trait TraitHeader
{
    public function header($arrayHeader = [])
    {
        if (!empty($arrayHeader)) {
            $this->header = $arrayHeader;
        }
        return $this;
    }

    public function applyHeader($curl)
    {

        if (!empty($this->header)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $this->header);
        } else {
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Accept: application/json',
                'Content-Type: application/json'
            ));
        }
    }
}
