<?php

namespace app\lib;

class Request
{
    public function body()
    {
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            foreach ($_GET as $key => $value) {
                $data[$key] = $value;
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($_POST as $key => $value) {
                $data[$key] = $value;
            }
        }
        return $data;
    }
}