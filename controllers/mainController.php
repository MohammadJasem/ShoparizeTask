<?php

namespace app\controllers;

use app\lib\APIResponse;
use app\lib\request;

class mainController
{
    public $response;
    private $request;
    private const M2Y = 1.09361;
    private const Y2M = 0.9144;
    private const unitsTitles = ['Y' => "yards", 'M' => "meters"];
    public function __construct()
    {
        $this->response = array();
        $this->request = new request();
    }
    
    public function sum()
    {
        
    }
}