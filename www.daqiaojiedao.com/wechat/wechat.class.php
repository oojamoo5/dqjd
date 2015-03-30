<?php
require_once 'keyword.php';
/*导入微信数据格式文件*/
require_once "wechat_msgformat.php";

/**
 * 微信响应，主要测试天气预报接口,同时开发自主开发微信响应消息
 */
class WeChat {

	public function __construct(){

		if (isset($_GET['echostr'])){
			$this->valid($_GET['echostr']);
		}else{
			$this->ResponseMsg();
		}
		
	}


	protected function ResponseMsg(){
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

		if ($postStr){
			//读取xml获取响应对象
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		
			//获取请求类型，文字，图片等
			$RX_TYPE = trim(strtolower($postObj->MsgType));
		
			switch($RX_TYPE){
				case "text":
					$content = $this->handleText($postObj);
					break;
				case "event":
					$content = $this->handleEvent($postObj);
				default:
					$this->handleDefault();
					break;
			}
			echo $content;
		} else {
			$content = '111';
		}
	}

	/**
	 * 响应文字类型
	 * @param  [Objet] 获取发送消息对象
	 * @return [String] 返回XML格式字符串
	 */
	protected function handleText($postObj){
		global $keywords;

		/*$keyword = mb_substr($postObj->Content, 0, strlen($postObj->Content), "UTF-8");

		if (in_array($keyword, $keywords['city'])){
			$info = $this->api_weather($keyword);
			
			if ($info){
				$message = "[{$info['currentCity']}天气预报]\n\nPM2.5浓度\n{$info['pm25']}\n\n实时天气\n{$info['weather_data'][0]['weather']} {$info['weather_data'][0]['temperature']} {$info['weather_data'][0]['wind']}\n\n";
			}

			return  $this->returnText($postObj, $message);
		}
		else if(array_key_exists($keyword, $keywords['music'])){
			$message = $keywords['music'][$keyword];
			$this->log($this->returnMusic($postObj, $message));
			//return  $this->returnMusic($postObj, $message);
		} */
		
		return $this->returnText($postObj, '<a href="http://www.dqfhjd.com/wechat/sample.php">一件关注</a>');
		
	}
	
	protected function handleEvent($postObj){
		switch ($postObj->Event) {
			case "subscribe":
				$content = '<a href="http://www.dqfhjd.com/wechat/test.html">一点关注微信</a>';//"感谢关注myduangduang!荆轲刺秦王~";
				break;
		}
		
		return $this->returnText($postObj, $content);
	}
	
	protected function handleDefault(){
	
	}

	/**
	 * 验证返回
	 * @return [String] 返回微信默认字符串
	 */
	protected function valid($echostr){
		if($this->checkSignature()){
			echo $echostr;
		}
	}
	/**
	 * 对微信传递过来的3个参数做加密验证
	 * @return [Boolean] 范围成功true，失败false
	 */
	protected function checkSignature(){
	    $signature = $_GET["signature"];
	    $timestamp = $_GET["timestamp"];
	    $nonce = $_GET["nonce"];	
	  
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );

		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	
	protected function log($content, $mode = 'a+'){
		if (is_object($content) || is_array($content)){
			$content = json_encode($content);
		}
		$fp = fopen('log.txt', $mode);
		fwrite($fp, $content . "\n");
		fclose($fp);
	}
	
	protected function returnText($postObj, $content){
		global $format;
		$fromUserName = $postObj->FromUserName;
		$toUserName = $postObj->ToUserName;
		return sprintf($format['text'], $fromUserName, $toUserName,time(), $content);
	}
	
	protected function returnMusic($postObj, $content){
		global $format;
		$fromUserName = $postObj->FromUserName;
		$toUserName = $postObj->ToUserName;
		return sprintf($format['music'], $fromUserName, $toUserName, time(), $content['title'], $content['description'], $content['music_url'], $content['hq_music_url'], '');
	}

	protected function api_weather($city){

		require_once 'curl.php';
		$curl = new CURL();

		$url = sprintf(WEATHER_URL, $city);

		$json = $curl->get($url);
		$result = json_decode($json, true);
		
		if ($result['error'] == 0){
			return $result['results'][0];
		}
	}
}