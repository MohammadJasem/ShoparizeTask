<?php

namespace app\controllers;

use app\lib\request;

class mainController
{
    private $request;
    public function __construct()
    {
        $this->response = array();
        $this->request = new request();
    }
}