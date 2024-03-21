<?php

namespace GabrielBinottiCurl;

trait TraitAuth
{

    public function auth($typeAuth = null, $authValue = null)
    {

        if(!empty($typeAuth) && !empty($authValue)){
            $this->typeAuth     = $typeAuth;
            $this->authValue    = $authValue;
        }

        return $this;
    }

    public function applyAuth($curl)
    {
        if(!empty($this->typeAuth) && !empty($this->authValue)){
            if ($this->typeAuth === 'basic') {
                
                curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($curl, CURLOPT_USERPWD, $this->authValue);

            } elseif ($this->typeAuth === 'jwt') {
                $this->header[] = 'Authorization: Bearer ' . $this->authValue;
                
            }
        }
    }
}