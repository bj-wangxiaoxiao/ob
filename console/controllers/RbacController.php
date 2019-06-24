<?php

namespace console\controllers;

use backend\config\AuthConfig;
use backend\models\AuthAssignment;
use backend\models\AuthItem;
use Yii;
use yii\base\Exception;
use yii\console\Controller;
use yii\rbac\Item;
use yii\rbac\ManagerInterface;

class RbacController extends Controller
{
	private $auth;
	private $handle;
	private $msg;
	private $role;
	
	public function init()
	{
		$this->auth = AuthConfig::getAuth();
		$this->handle = AuthConfig::getHandle();
		$this->role = AuthConfig::getRole();
		parent::init(); // TODO: Change the autogenerated stub
	}
	
	/**
	 * init rbac auth ,will clear all old data,please see AuthConfig to diy your auth info
	 * @throws \Exception
	 */
	public function actionInit()
	{
		$assigments = AuthAssignment::find()->asArray()->all();
		$amg = Yii::$app->authManager;
		$this->_addPermission($amg);
		$this->_addRole($amg);
		//如果assignment已经有数据了，则不初始化管理员信息了
		//以上两个方法会清空assignment里的数据，所以此处需要把数据先查出来，等清空后再存进去
		if(empty($assigments)){
			$this->_addAssignment($amg);
		}else{
			foreach ($assigments as $assigment) {
				$model = new AuthAssignment();
				$form['AuthAssignment'] = $assigment;
				$model->load($form);
				$model->save();
			}
		}
	}
	
	private function _addPermission(ManagerInterface $amg)
	{
		//1、清空所有的权限
		AuthItem::deleteAll(['type' => Item::TYPE_PERMISSION]);
		//循环配置文件，逐一添加需要的权限
		foreach ($this->auth as $auth => $item) {
			$auth_desc = $item['desc'];
			$this->handle = array_merge($this->handle,$item['extraHandle']);
			foreach ($this->handle as $handle => $desc) {
				$auth_handle = $auth . '/' . $handle;
				$p = $amg->createPermission($auth_handle);
				$p->description = $auth_desc . $desc;
				$amg->add($p);
				$this->msg = "add permission [{$auth_handle}] success !";
				$succ++;
				$this->outputInfo();
			}
		}
		$this->msg = "add permission success count : [{$succ}]";
		$this->outputInfo();
	}
	
	private function _addRole(ManagerInterface $amg)
	{
		$succ = 0;
		//1、清空所有的角色
		AuthItem::deleteAll(['type' => Item::TYPE_ROLE]);
		//循环配置文件，逐一添加需要的角色
		foreach ($this->role as $name => $info) {
			$desc = $info['desc'];
			$parent = $info['parent'];
			$role = $amg->createRole($name);
			$role->description = $desc;
			$amg->add($role);
			/**
			 * 是否添加层级关系
			 */
			if($parent){
				$parent_role = $amg->getRole($parent);
				try {
					$amg->addChild($parent_role, $role);
				} catch (Exception $e) {
					$this->msg = 'parent has been added';
					$this->outputInfo();
				}
				$this->msg = "add {$parent_role->name}'s child [$name] success !";
				$this->outputInfo();
			}
			$this->msg = "add role [{$name}] success !";
			$succ++;
			$this->outputInfo();
		}
		$this->msg = "add role success count : [{$succ}]";
		$this->outputInfo();
	}
	
	public function outputInfo()
	{
		print_r("{$this->msg}\n");
	}
	
	/**
	 * 初始化adminUser的第一个用户为超级管理员
	 * @param ManagerInterface $amg
	 * @return bool
	 * @throws \Exception
	 */
	private function _addAssignment(ManagerInterface $amg)
	{
		$succ = $error = 0;
		$super_admin_id = AuthConfig::getSuperAdminId();
		if(empty($super_admin_id)){
			$this->msg = "there is no admin user in system !";
			$this->outputInfo();
			return false;
		}
		$super_role = $amg->getRole(AuthConfig::SUPER_ADMIN);
		$per = $amg->getPermissions();
		
		//给第一个用户添加超管角色
		$one = AuthAssignment::findOne(['item_name'=>AuthConfig::SUPER_ADMIN]);
		if($one){
			$this->msg = 'SuperAdmin has been set !';
			$this->outputInfo();
		}else{
			$r_assign = $amg->assign($super_role,$super_admin_id);
			$this->msg = $r_assign ? "set admin_user_id [{$super_admin_id}] as SuperAdmin success !" : "set admin_user_id [{$super_admin_id}] as SuperAdmin} error !";
			$this->outputInfo();
		}
		
		
		//给超管角色分配所有权限
		foreach ($per as $item) {
			$r = $amg->addChild($super_role,$item);
			$r ? $succ++ : $error++;
		}
		$this->msg = "Set all permissions for super administrators success count : [{$succ}]";
		$this->outputInfo();
		$this->msg = "Set all permissions for super administrators error count : [{$error}]";
		$this->outputInfo();
	}
	
}