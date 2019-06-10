<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/8 0008
 * Time: 上午 8:53
 */
namespace backend\config;

use common\models\AdminUser;

/**
 * 此处定义的是后台有哪些功能模块是需要入库，进行权限控制的，理论上是controller下的所有控制器都是功能，都要入库做权限控制（SiteController除外）
 * Class AuthConfig
 * @package backend\config
 */
class AuthConfig
{
	const SUPER_ADMIN = 'SuperAdmin';//统一定义超级管理员的英文名称
	/**
	 * 功能列表
	 * @var array
	 */
	private static  $auth = [
		'adminuser'=>[
			'desc'=>'管理员',
			'extraHandle'=>['privilege'=>'修改权限','assignment'=>'角色权限分配'],//设置其他的不在$handle里的功能名称
		],
		'Article'=>[
			'desc'=>'文章',
			'extraHandle'=>[],
		],
		'comment'=>[
			'desc'=>'评论',
			'extraHandle'=>[],
		],
		'user'=>[
			'desc'=>'用户',
			'extraHandle'=>[],
		],
		'auth-item'=>[
			'desc'=>'角色',
			'extraHandle'=>[],
		],
	];
	
	/**
	 * 每个功能可执行的操作列表
	 * @var array
	 */
	private static $handle = [
		'index'=>'列表',
		'view'=>'详情',
		'create'=>'新建',
		'update'=>'修改',
		'delete'=>'删除',
	];
	
	private static $role = [
		self::SUPER_ADMIN=>[
			'desc'=>'超级管理员',
			'parent'=>'',
		],
		'Admin'=>[
			'desc'=>'管理员',
			'parent'=>self::SUPER_ADMIN,
		],
		'ArticleAdmin'=>[
			'desc'=>'文章管理员',
			'parent'=>'Admin',
		]
	];
	
	public static function getAuth(){
		return self::$auth;
	}
	
	public static function getHandle(){
		return self::$handle;
	}
	
	public static function getRole(){
		return self::$role;
	}
	
	/**
	 * 设置哪个用户为超管角色，这里默认设置第一个创建的用户为超管角色
	 * @return int
	 */
	public static function getSuperAdminId(){
		return intval(AdminUser::find()->select('admin_user_id')->orderBy(['create_time'=>SORT_ASC])->limit(1)->scalar());
	}
}
