<?php

namespace app\lib;

class APIResponse {
	private $_success;
	private $_messages = array();
	private $_data;
	private $_httpStatusCode;
	private $_toCache = false;
	private $_responseData = array();

	private function setSuccess($success) {
		$this->_success = $success;
	}

	private function addMessage($message) {
		$this->_messages[] = $message;
	}

	private function setData($data) {
		$this->_data = $data;
	}

	private function setHttpStatusCode($httpStatusCode) {
		$this->_httpStatusCode = $httpStatusCode;
	}

	public function toCache($toCache) {
		$this->_toCache = $toCache;
	}

	private function send() {
		header('Content-type:application/json;charset=utf-8');

		if($this->_toCache == true)
			header('Cache-Control: max-age=60');
		else
			header('Cache-Control: no-cache, no-store');

		if(!is_numeric($this->_httpStatusCode) || ($this->_success !== false && $this->_success !== true )) {
			http_response_code(500);
			$this->_responseData['statusCode'] = 500;
			$this->_responseData['success'] = false;
			$this->addMessage("Response creation error");
			$this->_responseData['messages'] = $this->_messages;
		}else {
			http_response_code($this->_httpStatusCode);
			$this->_responseData['statusCode'] = $this->_httpStatusCode;
			$this->_responseData['success'] = $this->_success;
			$this->_responseData['messages'] = $this->_messages;
			$this->_responseData['data'] = $this->_data;
		}

		echo json_encode($this->_responseData);
	}

    public function sendResponse($httpStatusCode, $success, $message = "", $data = "")
    {
        $this->setHttpStatusCode($httpStatusCode);
        $this->setSuccess($success);
        if($message != "")
            $this->addMessage($message);
        if($data != "")
            $this->setData($data);
        $this->send();
        exit;
    }
}