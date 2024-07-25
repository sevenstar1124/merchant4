<?php

namespace App\Libraries;

use TCPDF;

class TcpdfLibrary extends TCPDF
{
    public function __construct()
    {
        parent::__construct();
    }
}
