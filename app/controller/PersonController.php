<?php

namespace controller;
use model\PersonModel;
use framework\Upload;
class PersonController extends Controller
{
	protected $user;
	protected $upload;

	function __construct()
	{
		parent::__construct();
		$this->user = new PersonModel();
	}
	
	function change()
	{
		if (empty($_SESSION['username'])) {
			$this->notice('登陆后才能设置个人信息' , 'index.php?m=user&a=index');
			exit;
		}
		$username= $_SESSION['username'];

		$userInfo = $this->user->getInfo($_SESSION['username']);
		// var_dump($userInfo);

		if (!empty($_POST['username'])) {
			$arrChange['username'] = $_POST['username'];
			$nameExists = $this->user->nameExists($arrChange['username']);
			if ($nameExists !== false) {
				$this->notice('用户名已存在');
				exit;
			}
		}

		
		

		if (!empty($_POST['pwd'])) {
			if (!empty($_POST['newPwd'])) {
				if (md5($_POST['pwd']) == $userInfo['password']) {
					if (!empty($_POST['newPwd'])) {
						$arrChange['password'] = md5($_POST['newPwd']);
					}
				} else {
					$this->notice('旧密码不正确');
					exit;
				}
			}
			if (!empty($_POST['phone'])) {
				if (md5($_POST['pwd']) == $userInfo['password']) {
					if (strlen($_POST['phone']) !== 11) {
						$this->notice('手机号长度不正确');
						exit;
					}
					$patternPhone = "/^134[0-8]\d{7}$|^13[^4]\d{8}$|^14[5-9]\d{8}$|^15[^4]\d{8}$|^16[6]\d{8}$|^17[0-8]\d{8}$|^18[\d]{9}$|^19[8,9]\d{8}$/";
					if (!preg_match( $patternPhone, $_POST['phone'])) {
						$this->notice('手机号格式不支持');
						exit;
					}
					$arrChange['phone'] = $_POST['phone'];
					$phoneExists = $this->user->phoneExists($arrChange['phone']);
					if ($phoneExists !== false) {
						$this->notice('手机号已被注册');
						exit;
					}
				} else {
					$this->notice('旧密码不正确');
					exit;
				}
			}
		}
	
		//上传图片
		if (!empty($_FILES['face']['name'])) {
			// echo ' 逼';
			$upload = new Upload();
			$data['picture'] = $upload->uploadFile('face');
			$arrChange['picture'] = $data['picture'];
		}
		if (!empty($arrChange)) {
			$change = $this->user->changeInfo($arrChange , $username);
			if ($change !== false) {
				$this->notice('修改个人资料完成');
				//新的个人资料返回session只有username和pic
				if (!empty($_POST['username'])) {
					$_SESSION['username'] = $arrChange['username'];
				}
				if (!empty($_FILES['face']['name'])) {
					$_SESSION['pic'] = $arrChange['picture'];
				}
				exit;
			} else {
				$this->notice('修改个人资料失败');
				exit;
			}
		}
		$this->notice('未修改个人资料');
		exit;
	}

	//默认展示
	function index()
	{		
		if (empty($_SESSION['username'])) {
			$this->notice('登陆后才能设置个人信息' , 'index.php?m=user&a=index');
			exit;
		}
		$username= $_SESSION['username'];

		$userInfo = $this->user->getInfo($_SESSION['username']);
		// var_dump($userInfo);
		// var_dump($_SESSION);

		// 需要从数据库中筛选内的内容
		$webTitle = $this->user->getWebMsg('webTitle');
		$this->assign('webTitle' , $webTitle);

		$webName = $this->user->getWebMsg('webName');
		$this->assign('webName' , $webName);

		$webUrl = $this->user->getWebMsg('webUrl');
		$this->assign('webUrl' , $webUrl);

		$webInfo = $this->user->getWebMsg('webInfo');
		$this->assign('webInfo' , $webInfo);

		$webMore = $this->user->getWebMsg('webMore');
		$this->assign('webMore' , $webMore);

		$link = $this->user->getLink();
		$this->assign('link' , $link);

		$this->display('user/person.html');
	}
}
