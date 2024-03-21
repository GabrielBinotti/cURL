<?php

namespace GabrielBinottiCurl;

interface InterfaceOptions
{
    public function options($arrayOptions = []);
    public function applyOptions($curl);
}