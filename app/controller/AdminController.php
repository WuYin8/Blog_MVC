<?php

namespace controller;
use model\AdminModel;
use framework\Page;
class AdminController extends Controller
{
	protected $user;
	protected $upload;

	function __construct()
	{
		parent::__construct();
		$this->user = new AdminModel();
	}

	function login()
	{
		
		$this->display('admin/adminLogin.html');
	}

	function index()
	{
		if (!empty($_POST)) {
			if (empty($_POST['username'])) {
			$this->notice('用户名不能为空');
			exit;
			}
			$nameEixsts = $this->user->nameEixsts($_POST['username']);
			if ($nameEixsts == false) {
				$this->notice('用户名不存在');
				exit;
			}
			$isAdmin = $this->user->isAdmin($_POST['username']);
			if ($isAdmin !== '1') {
				$this->notice('需要管理员权限');
				exit;
			}
			if (empty($_POST['password'])) {
				$this->notice('密码不能为空');
				exit;
			}
			$pwdAdmin = $this->user->pwdAdmin($_POST['username']);
			if (md5($_POST['password']) !== $pwdAdmin) {
				$this->notice('密码不正确');
				exit;
			} else {
				$adminInfo = $this->user->getAdminInfo($_POST['username']);
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['uid'] = $adminInfo['uid'];
				$_SESSION['pic'] = $adminInfo['picture'];
				$_SESSION['undertype'] = $adminInfo['undertype'];
			}
		}

		if (empty($_SESSION['username'])) {
			$this->notice('用户未登录' , 'index.php?m=admin&a=login');
			exit;
		}
		if (empty($_SESSION['undertype'])) {
			$this->notice('请重新登录' , 'index.php?m=admin&a=login');
			exit;
		}

		//分页需要
		$totalCount = $this->user->userTotalCount();
		$page = new Page(10 , $totalCount);
		$page = $page->allPage();
		$this->assign('page' , $page);

		//要展示的帖子信息，一页10个
		if (empty($_GET['page'])) {
			$pageStart = 0;
		} else {
			$pageStart = ($_GET['page'] - 1)*10;
		}

		$users = $this->user->getUsers($pageStart);
		$this->assign('users' , $users);

		$this->display('admin/adminIndex.html');
		exit;
	}

	//登出
	function logout()
	{
		unset($_SESSION['name']);
		unset($_SESSION['uid']);
		unset($_SESSION['pic']);
		unset($_SESSION['undertype']);
		session_destroy();
		$this->notice('退出成功' , 'index.php?m=admin&a=login');
		exit;
	}
	//锁定用户
	function userLock()
	{
		// var_dump($_POST);

		if (empty($_SESSION['username'])) {
			$this->notice('用户未登录' , 'index.php?m=admin&a=login');
			exit;
		}
		if (empty($_SESSION['undertype'])) {
			$this->notice('请重新登录' , 'index.php?m=admin&a=login');
			exit;
		}

		if (!empty($_POST['uid'])) {
			$displayID = $_POST['uid'];
			$displayID = join(',', $displayID);
			$display = ['allowlogin'=>1];			
			$this->user->lockUser($display , $displayID);
		}
		header('location:index.php?m=admin&a=index');
		exit;
	}
	//解锁用户
	function userDel()
	{

		if (empty($_SESSION['username'])) {
			$this->notice('用户未登录' , 'index.php?m=admin&a=login');
			exit;
		}
		if (empty($_SESSION['undertype'])) {
			$this->notice('请重新登录' , 'index.php?m=admin&a=login');
			exit;
		}

		//分页需要
		$totalCount = $this->user->userDelCount();
		$page = new Page(10 , $totalCount);
		$page = $page->allPage();
		$this->assign('page' , $page);

		//要展示的帖子信息，一页10个
		if (empty($_GET['page'])) {
			$pageStart = 0;
		} else {
			$pageStart = ($_GET['page'] - 1)*10;
		}

		$users = $this->user->getLockUsers($pageStart);
		$this->assign('users' , $users);

		if (!empty($_POST['uid'])) {
			$displayID = $_POST['uid'];
			$displayID = join(',', $displayID);
			$display = ['allowlogin'=>0];			
			$this->user->lockUser($display , $displayID);
			header('location:index.php?m=admin&a=userDel');
		}
		$this->display('admin/adminIndex.html');
	}
	//删除用户
	function deleteUser()
	{

		if (empty($_SESSION['username'])) {
			$this->notice('用户未登录' , 'index.php?m=admin&a=login');
			exit;
		}
		if (empty($_SESSION['undertype'])) {
			$this->notice('请重新登录' , 'index.php?m=admin&a=login');
			exit;
		}

		if (!empty($_GET['delId'])) {
			$delUid = $_GET['delId'];
			$this->user->UserDelete($delUid);
			header('location:index.php?m=admin&a=userDel');
		}
		$this->display('admin/adminIndex.html');
	}

	//文章管理
	function content()
	{

		if (empty($_SESSION['username'])) {
			$this->notice('用户未登录' , 'index.php?m=admin&a=login');
			exit;
		}
		if (empty($_SESSION['undertype'])) {
			$this->notice('请重新登录' , 'index.php?m=admin&a=login');
			exit;
		}
		

		//分页需要
		$totalCount = $this->user->contentTotalCount();
		$page = new Page(6 , $totalCount);
		$page = $page->allPage();
		$this->assign('page' , $page);

		//要展示的帖子信息，一页六个
		if (empty($_GET['page'])) {
			$pageStart = 0;
		} else {
			$pageStart = ($_GET['page'] - 1)*6;
		}

		$contents = $this->user->getContents($pageStart);
		$this->assign('contents' , $contents);
		$this->display('admin/adminContents.html');
		exit;
	}
	//文章回收
	function contentLock()
	{

		if (empty($_SESSION['username'])) {
			$this->notice('用户未登录' , 'index.php?m=admin&a=login');
			exit;
		}
		if (empty($_SESSION['undertype'])) {
			$this->notice('请重新登录' , 'index.php?m=admin&a=login');
			exit;
		}
		

		$contents = $this->user->getContents();
		$this->assign('contents' , $contents);
		if (!empty($_POST['id'])) {
			$displayID = $_POST['id'];
			$displayID = join(',', $displayID);
			$display = ['isdel'=>1];			
			$this->user->lockContent($display , $displayID);
		}

		header('location:index.php?m=admin&a=content');
		exit;
	}
	//文章恢复
	function contentDel()
	{

		if (empty($_SESSION['username'])) {
			$this->notice('用户未登录' , 'index.php?m=admin&a=login');
			exit;
		}
		if (empty($_SESSION['undertype'])) {
			$this->notice('请重新登录' , 'index.php?m=admin&a=login');
			exit;
		}
		

		//分页需要
		$totalCount = $this->user->contentDelCount();
		$page = new Page(6 , $totalCount);
		$page = $page->allPage();
		$this->assign('page' , $page);

		//要展示的帖子信息，一页六个
		if (empty($_GET['page'])) {
			$pageStart = 0;
		} else {
			$pageStart = ($_GET['page'] - 1)*6;
		}

		$contents = $this->user->getLockContent($pageStart);
		$this->assign('contents' , $contents);

		if (!empty($_POST['id'])) {
			$displayID = $_POST['id'];
			$displayID = join(',', $displayID);
			$display = ['isdel'=>0];			
			$this->user->lockContent($display , $displayID);
			header('location:index.php?m=admin&a=contentDel');
		}
		$this->display('admin/adminContents.html');
	}
	//文章删除
	function deleteContent()
	{

		if (empty($_SESSION['username'])) {
			$this->notice('用户未登录' , 'index.php?m=admin&a=login');
			exit;
		}
		if (empty($_SESSION['undertype'])) {
			$this->notice('请重新登录' , 'index.php?m=admin&a=login');
			exit;
		}
		
		if (!empty($_GET['delId'])) {
			//查询是否有回帖
			$haveReply = $this->user->haveReply($_GET['delId']);
			if ($haveReply !== false ) {
				$this->notice('文章内还有回复未删除，请删除回复后再试');
				exit;
			}
			$delTid = $_GET['delId'];
			$this->user->ContentDelete($delTid);
			header('location:index.php?m=admin&a=contentDel');
		}
		$this->display('admin/adminContents.html');
	}

	//回复管理
	function reply()
	{

		if (empty($_SESSION['username'])) {
			$this->notice('用户未登录' , 'index.php?m=admin&a=login');
			exit;
		}
		if (empty($_SESSION['undertype'])) {
			$this->notice('请重新登录' , 'index.php?m=admin&a=login');
			exit;
		}
		

		//分页需要
		$totalCount = $this->user->replyTotalCount();
		$page = new Page(6 , $totalCount);
		$page = $page->allPage();
		$this->assign('page' , $page);

		//要展示的帖子信息，一页六个
		if (empty($_GET['page'])) {
			$pageStart = 0;
		} else {
			$pageStart = ($_GET['page'] - 1)*6;
		}

		$replys = $this->user->getReplys($pageStart);
		$this->assign('replys' , $replys);

		$this->display('admin/adminReplys.html');
		exit;
	}

	//回复回收
	function replyLock()
	{

		if (empty($_SESSION['username'])) {
			$this->notice('用户未登录' , 'index.php?m=admin&a=login');
			exit;
		}
		if (empty($_SESSION['undertype'])) {
			$this->notice('请重新登录' , 'index.php?m=admin&a=login');
			exit;
		}
		
		$replys = $this->user->getReplys();
		$this->assign('replys' , $replys);
		if (!empty($_POST['id'])) {
			$displayID = $_POST['id'];
			$displayID = join(',', $displayID);
			$display = ['isdel'=>1];			
			$this->user->lockReply($display , $displayID);
		}

		header('location:index.php?m=admin&a=reply');
		exit;
	}
	//回复恢复
	function replyDel()
	{

		if (empty($_SESSION['username'])) {
			$this->notice('用户未登录' , 'index.php?m=admin&a=login');
			exit;
		}
		if (empty($_SESSION['undertype'])) {
			$this->notice('请重新登录' , 'index.php?m=admin&a=login');
			exit;
		}
		

		//分页需要
		$totalCount = $this->user->replyDelCount();
		$page = new Page(6 , $totalCount);
		$page = $page->allPage();
		$this->assign('page' , $page);

		//要展示的帖子信息，一页六个
		if (empty($_GET['page'])) {
			$pageStart = 0;
		} else {
			$pageStart = ($_GET['page'] - 1)*6;
		}

		$replys = $this->user->getLockReply();
		$this->assign('replys' , $replys);

		if (!empty($_POST['id'])) {
			$displayID = $_POST['id'];
			$displayID = join(',', $displayID);
			$display = ['isdel'=>0];			
			$this->user->lockReply($display , $displayID);
			header('location:index.php?m=admin&a=replyDel');
		}
		$this->display('admin/adminReplys.html');
	}
	//回复删除
	function deleteReply()
	{

		if (empty($_SESSION['username'])) {
			$this->notice('用户未登录' , 'index.php?m=admin&a=login');
			exit;
		}
		if (empty($_SESSION['undertype'])) {
			$this->notice('请重新登录' , 'index.php?m=admin&a=login');
			exit;
		}
		
		if (!empty($_GET['delId'])) {
			$delTid = $_GET['delId'];
			$this->user->ReplyDelete($delTid);
			header('location:index.php?m=admin&a=replyDel');
		}
		$this->display('admin/adminReplys.html');
	}
}
