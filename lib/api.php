<?php

namespace app\lib;

use app\lib\APIResponse;

class api
{
	protected static $routeFound = false;
	
	public function get($thisUri,$callback)
	{
		if(!self::$routeFound){
			$uri = str_replace(API_URI, "/",$_SERVER['REQUEST_URI']);
			$method = $_SERVER['REQUEST_METHOD'];
			if($uri==$thisUri && $method=='GET'){
				self::$routeFound = true;
				if(is_callable($callback[0]))
					$callback[0]();
				else if(is_callable(array(new $callback[0], $callback[1]))){
					$controller = new $callback[0];
					$method = $callback[1];
					if(method_exists($controller,$method)){
						$controller->$method();	
					}
				}else{
                    $response = new APIResponse();
                    $response->sendResponse(500, false, "The method {$callback[1]} is not defined in {$callback[0]}");
				}
			}
		}
	}
	
	public function post($thisUri,$callback)
	{
		if(!self::$routeFound){
			$uri = str_replace(API_URI, "/",$_SERVER['REQUEST_URI']);
			$method = $_SERVER['REQUEST_METHOD'];
			if($uri==$thisUri && $method=='POST'){
				self::$routeFound = true;
				if(is_callable($callback[0]))
					$callback[0]();
				else if(is_callable(array(new $callback[0], $callback[1]))){
					$controller = new $callback[0];
					$method = $callback[1];
					if(method_exists($controller,$method)){
						$controller->$method();
						echo json_encode($controller->response);
					}
				}else{
                    $response = new APIResponse();
					$response->sendResponse(500, false, "The method {$callback[1]} is not defined in {$callback[0]}");
				}
			}
		}
	}
	
	public function notFound_404()
	{
		if(!self::$routeFound){
            $response = new APIResponse();
			$response->sendResponse(500, false, "Endpoint is not found");
        }
	}
}