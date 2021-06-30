<?php

namespace app\controllers;

use app\lib\apiResponse;
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
        $body = $this->request->body();
        $response = new APIResponse();
        if (
            isset($body["resultUnit"])
            && isset($body["distance1Val"])
            && isset($body["distance2Val"])
            && isset($body["distance1Unit"])
            && isset($body["distance2Unit"])
        ){
            $resultUnit = strtoupper($this->request->body()['resultUnit']);
            $distance1Val = $this->request->body()['distance1Val'];
            $distance2Val = $this->request->body()['distance2Val'];
            $distance1Unit = strtoupper($this->request->body()['distance1Unit']);
            $distance2Unit = strtoupper($this->request->body()['distance2Unit']);
            //checking if values are empty or not in correct format
            if(
                $resultUnit == '' || ($resultUnit != 'M' && $resultUnit != 'Y')
                || $distance1Val == '' || !is_numeric($distance1Val) || $distance1Val < 0
                || $distance2Val == '' || !is_numeric($distance2Val) || $distance2Val < 0
                || $distance1Unit == '' || ($distance1Unit != 'M' && $distance1Unit != 'Y')
                || $distance2Unit == '' || ($distance2Unit != 'M' && $distance2Unit != 'Y')
            )
                $response->sendResponse(400, false, "All params must be not blank. You have to define distances values and each one unit and reult's unit. Distances values must be greater or equal to zero. Distances units and result unit params must be Y or M and can be different between each other");
            else{
                $result = 0;
                //check if the distances have different units. If so go to 1 else go to 2
                //1.sum them then check if the distances have different unit to result. if so change it to resault's unit
                //2. check the distance that has different unit to result and cahnge it then get the sum
                if($distance1Unit == $distance2Unit){
                    $result = $distance1Val + $distance2Val;
                    if($distance1Unit != $resultUnit){
                        if($resultUnit == 'Y')
                            $result *= self::M2Y;
                        else
                            $result *= self::Y2M;
                    }
                }else{
                    if($distance1Unit != $resultUnit){
                        if($distance1Unit == 'Y')
                            $distance1Val *= self::Y2M;
                        else
                            $distance1Val *= self::M2Y;
                    }else{
                        if($distance2Unit == 'Y')
                            $distance2Val *= self::Y2M;
                        else
                            $distance2Val *= self::M2Y;
                    }
                    $result = $distance1Val + $distance2Val;
                }
                $response->sendResponse(200, true, "Returned result in ".self::unitsTitles[$resultUnit], ['result' => $result]);
            }
        }else
            $response->sendResponse(400, false, "Please set all parameters");
    }
}