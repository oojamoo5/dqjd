<?php
/*
Sean Huber CURL library
This library is a basic implementation of CURL capabilities.
It works in most modern versions of IE and FF.
==================================== USAGE ====================================
It exports the CURL object globally, so set a callback with setCallback($func).
(Use setCallback(array('class_name', 'func_name')) to set a callback as a func
that lies within a different class)
Then use one of the CURL request methods:
get($url);
post($url, $vars); vars is a urlencoded string in query string format.
Your callback function will then be called with 1 argument, the response text.
If a callback is not defined, your request will return the response text.
*/
class CURL {
	var $callback = false;
	function setCallback($func_name) {
		$this->callback = $func_name;
	} 
	function doRequest($method, $url, $vars,$proxy=true,$header_info=false) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_NOBODY,0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
//		curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
		if ($method == 'POST') {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
		}
        if($proxy){
            //通过代理请求
            curl_setopt($ch, CURLOPT_PROXYTYPE ,CURLPROXY_HTTP);
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL,1);
            curl_setopt($ch, CURLOPT_PROXY , API_CURLOPT_PROXY);
        }
		$data = curl_exec($ch);
        if($header_info){
            $header =curl_getinfo($ch);
			$errorno = curl_errno($ch);
        }
		curl_close($ch);
        if($header_info){
            return array("body"=>$data,"header"=>$header, 'errorno' => $errorno );
        }
		return $data;
	} 
	function get($url,$proxy=false,$header_info=false) {
		return $this->doRequest('GET', $url, 'NULL',$proxy,$header_info);
	} 
	function post($url, $vars,$proxy=false,$header_info = false) {
		return $this->doRequest('POST', $url, $vars,$proxy,$header_info);
	} 
} 

?>
