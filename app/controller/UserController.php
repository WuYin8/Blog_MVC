<?php

namespace controller;
use model\UserModel;
use framework\Ucpaas;
class UserController extends Controller
{
	protected $user;
	function __construct()
	{
		parent::__construct();
		$this->user = new UserModel();
	}
	//登录判断
	function login()
	{
		if (empty($_POST['loginName'])) {
			$this->notice('用户名不能为空');
			exit;
		}
		if (empty($_POST['loginPwd'])) {
			$this->notice('密码不能为空');
			exit;
		}
		$loginNameExists = $this->user->nameExists($_POST['loginName']);
		if ($loginNameExists == false) {
			$this->notice('用户名不存在');
			exit;
		}
		$loginNameDel = $this->user->nameDel($_POST['loginName']);
		if ($loginNameDel == '1') {
			$this->notice('用户名被锁定');
			exit;
		}
		$loginPwd = $this->user->loginPwd($_POST['loginName']);
		if ($loginPwd !== md5($_POST['loginPwd'])) {
			$this->notice('密码不正确');
			exit;
		}
		$this->notice('登录成功');
		$this->user->lasttime($_POST['loginName']);
		$_SESSION['username'] = $_POST['loginName'];
		$uid = $this->user->getUid($_SESSION['username']);
		$_SESSION['uid'] = $uid;
		$pic = $this->user->getPic($_SESSION['username']);
		$_SESSION['pic'] = $pic;
		exit;
	}
	//登出
	function logout()
	{
		unset($_SESSION['name']);
		unset($_SESSION['uid']);
		unset($_SESSION['pic']);
		session_destroy();
		$this->notice('退出成功');
	}
	//注册判断
	function register()
	{
		if (empty($_SESSION['code'])) {
			$this->notice('验证码获取失败，请重新拉取');
			exit;
		}
		$scode = $_SESSION['code'];
		if (empty($_POST['registerName'])) {
			$this->notice('用户名不能为空');
			exit;
		}
		if (strlen($_POST['registerName']) < 6 || strlen($_POST['registerName']) > 12) {
			$this->notice('用户名长度需在6~12位之间');
			exit;
		}
		$registerNameExists = $this->user->nameExists($_POST['registerName']);
		if ($registerNameExists !== false) {
			$this->notice('用户名已存在');
			exit;
		}
		$registerName = $_POST['registerName'];

		if (empty($_POST['registerPwd'])) {
			$this->notice('密码不能为空');
			exit;
		}
		if (strlen($_POST['registerPwd']) < 6 || strlen($_POST['registerPwd']) > 12) {
			$this->notice('密码长度需在6~12位之间');
			exit;
		}
		$registerPwd = $_POST['registerPwd'];

		if ($_POST['registerPwd2'] !== $registerPwd) {
			$this->notice('两次密码输入不一致');
			exit;
		}

		if (empty($_POST['phone'])) {
			$this->notice('手机号不能为空');
			exit;
		} else if (strlen($_POST['phone']) !== 11) {
			$this->notice('手机号长度不正确');
			exit;
		}
	$patternPhone = "/^134[0-8]\d{7}$|^13[^4]\d{8}$|^14[5-9]\d{8}$|^15[^4]\d{8}$|^16[6]\d{8}$|^17[0-8]\d{8}$|^18[\d]{9}$|^19[8,9]\d{8}$/";
		if (!preg_match( $patternPhone, $_POST['phone'])) {
			$this->notice('手机号格式不支持');
			exit;
		}
		$registerPhoneExists = $this->user->phoneExists($_POST['phone']);
		if ($registerPhoneExists !== false) {
			$this->notice('手机号已被注册');
			exit;
		}
		$phone = $_POST['phone'];

		if (empty($_POST['code'])) {
			$this->notice('验证码不能为空');
			exit;
		}
		$code = $_POST['code'];

	    if($code !== $scode){
	    	$this->notice('验证码错误');
			exit;
	    }else{
	    	$this->user->register($registerName , $registerPwd , $phone);
	    	$this->notice('注册成功');
			exit;
    	}
	}
	//接口用
	function Code()
	{
		//初始化必填
		$options['accountsid']='19a6efc75833a611174be919347c4e48';
		$options['token']='0cebe3d404b6405cba9412dcdaac438c';

		//初始化 $options必填
		$ucpass = new Ucpaas($options);

		//开发者账号信息查询默认为json或xml
		header("Content-Type:text/html;charset=utf-8");


		//封装验证码
		$str = '1234567890123567654323894325789';
		$code = substr(str_shuffle($str),0,5);
		$_SESSION['code']=$code;
		//短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
		$appId = "5957fe0cfb234f68bff623c7fcded2f8";
		//给那个手机号发送
		$to = $_GET['phone'];

		$templateId = "251655";
		//这就是验证码
		$param=$code;

		echo $ucpass->templateSMS($appId,$to,$templateId,$param);
	}
	//默认页面
	function index()
	{

		if (!empty($_SESSION['username'])) {
			$this->notice('您已登陆，正在返回首页' , 'index.php?m=index&a=index');
			exit;
		}	
		$this->display('user/user.html');
	}


}