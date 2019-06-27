<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/12 0012
 * Time: 上午 10:45
 */

namespace frontend\controllers;


use common\lib\ObLogger;
use common\lib\ObStrHelper;
use common\models\User;
use frontend\models\WxMsgRecord;
use frontend\models\WxUser;
use frontend\config\FrontendConfig;
use Yii;
use yii\helpers\Json;
use yii\log\Logger;

class WxController extends BaseController
{
	private $msg;
	private $backInfo;
	
	public function actionSetTemplateIndustry(){
		$wechat = Yii::$app->wechat;
		$data = [
			'filter'=>[
				'is_to_all'=>false,
				'tag_id'=>'测试',
			],
			'text'=>[
				'content'=>'起来喝水111！',
			],
			'msgtype'=>'text',
		];
		$r = $wechat->sendAll($data);
		var_dump($r);die;
	}
	public function actionCallback()
	{
		//1、定位服务器的校验
		if (isset($_GET['signature'])) {
			$this->_checkSignature();
		}
		//2、获取微信用户发送过来的信息，xml格式，转换成array
		$fileContent = file_get_contents("php://input");
		if (empty($fileContent)) {
			ObLogger::info('微信返回信息为空！');
			die;
		}
		$arr_wx_param = ObStrHelper::Xml2Array($fileContent);
		ObLogger::info($arr_wx_param, "微信发送的信息");
		//测试使用
//		$arr_wx_param = [
//			"ToUserName" => "gh_2d74316a329c",
//			"FromUserName" => "oK_2SwnIWZnAWJmFylRG85BHYn5A",
//			"CreateTime" => "1510820250",
//			"MsgType" => "text",
//			"Content" => "5435",
//			"MsgId" => "6488923564304268875"
//		];
		//3、获取的信息存到msg里
		$this->msg['msg_id'] = $arr_wx_param['MsgId'];
		$this->msg['content'] = $arr_wx_param['Content'];
		$this->msg['open_id'] = $arr_wx_param['FromUserName'];
		$this->msg['send_time'] = $arr_wx_param['CreateTime'];
		$this->msg['ToUserName'] = $arr_wx_param['ToUserName'];
		$this->msg['ip'] = Yii::$app->request->getUserIP();
		
		//4、如果是测试
		if (strtolower($arr_wx_param['Content']) == 'test') {
			$this->_responseMsg('test success');
		}
		
		//5、入库用户信息
		$this->_addUser();
		
		//6、入库用户发送的信息
		$msg_record = new WxMsgRecord();
		$msg_record->setAttributes($this->msg);
		$msg_record->wx_user_id = WxUser::findOne(['open_id'=>$this->msg['open_id']])->wx_user_id;
		if (!$msg_record->save()) {
			ObLogger::info($msg_record->getErrors(),'添加用户失败，报错信息');
		}
		
		//7、返回用户信息
		$this->_handleUserMsg();
	}
	
	private function _checkSignature()
	{
		ob_clean();
		//回调域名：http://ob.3brother.cn/wx/callback
		$nonce = $_GET['nonce'];
		$token = 'obtoken';
		$timestamp = $_GET['timestamp'];
		$echostr = $_GET['echostr'];
		$signature = $_GET['signature'];
		//形成数组，然后按字典序排序
		$array = array();
		$array = array($nonce, $timestamp, $token);
		sort($array);
		//拼接成字符串,sha1加密 ，然后与signature进行校验
		$str = sha1(implode($array));
		$debug_arr = [
			'desc' => '当次signature验证',
			'nonce' => $nonce,
			'token' => $token,
			'timestamp' => $timestamp,
			'echostr' => $echostr,
			'signature' => $signature,
			'str' => $str,
		];
		ObLogger::info($debug_arr);
		if ($str == $signature && $echostr) {
			//第一次接入weixin api接口的时候
			echo $echostr;
			exit;
		}
	}
	
	public function _responseMsg($text = '')
	{
		if (empty($this->msg['ToUserName'])) {
			ObLogger::info('当前发送者为空，无法发送信息');
		}
		$CreateTime = time();
		$textTpl = "<xml>
	            <ToUserName><![CDATA[{$this->msg['open_id']}]]></ToUserName>
	            <FromUserName><![CDATA[{$this->msg['ToUserName']}]]></FromUserName>
	            <CreateTime>{$CreateTime}</CreateTime>
	            <MsgType><![CDATA[text]]></MsgType>
	            <Content><![CDATA[%s]]></Content>
	            </xml>";
		echo sprintf($textTpl, $text);
		die;
	}
	
	/**
	 * 用来处理回复用户信息的逻辑
	 */
	private function _handleUserMsg()
	{
		$this->backInfo = $this->msg['content'];
		switch ($this->msg['content']) {
			case '喝水':
				$this->backInfo = '收到，以后将会定时提醒您喝水';
				$wx_user = WxUser::findOne(['open_id' => $this->msg['open_id']]);
				$wx_user->remind = FrontendConfig::WX_USER_REMIND_TRUE;//提醒喝水
				$r = $wx_user->save();
				ObLogger::info($r, '用户设置提醒结果');
				break;
			case '不喝水':
				$this->backInfo = '收到，关闭喝水提醒';
				$wx_user = WxUser::findOne(['open_id' => $this->msg['open_id']]);
				$wx_user->remind = FrontendConfig::WX_USER_REMIND_FALSE;//不提醒喝水
				$r = $wx_user->save();
				ObLogger::info($r, '用户设置不提醒结果');
				break;
		}
		
		$this->_responseMsg($this->backInfo);
	}
	
	/**
	 * 入库用户信息
	 */
	private function _addUser()
	{
		$r = false;
		$user_exist = true;
		$user = WxUser::findOne(['open_id' => $this->msg['open_id']]);
		if (!$user) {
			$user_exist = false;
			$user = new WxUser();
			$user->open_id = $this->msg['open_id'];
			$r = $user->save();
		}
		
		$debug = [
			'user_exist'=>$user_exist,
			'add_result' => $r,
			'open_id' => $this->msg['open_id']
		];
		ObLogger::info($debug, '添加用户');
	}
}