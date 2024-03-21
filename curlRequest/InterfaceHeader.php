<?php

namespace GabrielBinottiCurl;

interface InterfaceHeader
{
    public function header($arrayHeader = []);
    public function applyHeader($curl);
}