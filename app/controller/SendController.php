<?php

namespace controller;
use model\SendModel;
use framework\Page;
class SendController extends Controller
{
	protected $user;

	function __construct()
	{
		parent::__construct();
		$this->user = new SendModel();
	}
	//发表帖子
	function addDetails()
	{
		if (empty($_POST['title'])) {
			$this->notice('标题不能为空');
			exit;
		}
		if (strlen($_POST['title']) > 60) {
			$this->notice('标题长度不得大于60字节');
			exit;
		}
		if (empty($_POST['content'])) {
			$this->notice('发表内容不得为空');
			exit;
		}

		$isSend = $this->user->send($_POST['title'] , $_POST['content']);
		if ($isSend == false ) {
			$this->notice('发表失败');
			exit;
		}
		$this->notice('发表成功' , "index.php?m=single&a=index&id=$isSend");
		exit;
	}

	//默认展示
	function index()
	{

		if (empty($_SESSION['username'])) {
			$this->notice('只有博主可以发帖哦');
			exit;
		}

		$isAdmin = $this->user->isAdmin($_SESSION['username']);
		if ($isAdmin !== '1') {
			$this->notice('只有博主可以发帖哦');
			exit;
		}

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

		$this->display('send.html');
	}
}
