<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/12 0012
 * Time: 上午 10:45
 */

namespace frontend\controllers;


use common\lib\ObLogger;
use Yii;
use yii\helpers\Json;
use yii\log\Logger;

class WxController extends BaseController
{
	private $msg;
	public function actionCallback(){
		if(isset($_GET['signature'])){
			$this->_checkSignature();
		}
		$fileContent = file_get_contents("php://input");
		ObLogger::info($fileContent);
		if(empty($fileContent)){
			die;
		}
		ObLogger::info("当次微信返回值：".$fileContent);
		$arr_wx_param = json_decode(json_encode(simplexml_load_string($fileContent, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
		
		if(strtolower($arr_wx_param['Content']) == 'test'){
			$this->_responseMsg('test success');
		}
		//测试使用:player_id:100107
//		$arr_wx_param= [
//			"ToUserName"=>"gh_8869f5a90a22",
//			"FromUserName"=>"oZUXAwWI0AIkN1BPgOFFFVyM0CAM",
//			"CreateTime"=>"1510820250",
//			"MsgType"=>"text",
//			"Content"=>"5435",
//			"MsgId"=>"6488923564304268875"
//		];
		$this->msg['FromUserName']=$arr_wx_param['FromUserName'];
		$this->msg['ToUserName']=$arr_wx_param['ToUserName'];
		ObLogger::info("公众号中用户发送的信息".Json::encode($arr_wx_param));
	}
	
	private function _checkSignature(){
		ob_clean();
		//回调域名：http://ob.3brother.cn/wx/callback
		$nonce     = $_GET['nonce'];
		$token     = 'obtoken';
		$timestamp = $_GET['timestamp'];
		$echostr   = $_GET['echostr'];
		$signature = $_GET['signature'];
		//形成数组，然后按字典序排序
		$array = array();
		$array = array($nonce, $timestamp, $token);
		sort($array);
		//拼接成字符串,sha1加密 ，然后与signature进行校验
		$str = sha1( implode( $array ) );
		$debug_arr=[
			'desc'=>'当次signature验证',
			'nonce'=>$nonce,
			'token'=>$token,
			'timestamp'=>$timestamp,
			'echostr'=>$echostr,
			'signature'=>$signature,
			'str'=>$str,
		];
		ObLogger::info($debug_arr);
		if( $str  == $signature && $echostr ){
			//第一次接入weixin api接口的时候
			echo  $echostr;
			exit;
		}
	}
	
	public function _responseMsg($text=''){
		$CreateTime = time();
		$textTpl = "<xml>
	            <ToUserName><![CDATA[{$this->msg['FromUserName']}]]></ToUserName>
	            <FromUserName><![CDATA[{$this->msg['ToUserName']}]]></FromUserName>
	            <CreateTime>{$CreateTime}</CreateTime>
	            <MsgType><![CDATA[text]]></MsgType>
	            <Content><![CDATA[%s]]></Content>
	            </xml>";
		echo  sprintf($textTpl,$text);die;
	}
}