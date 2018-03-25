<?php

namespace controller;
use model\SingleModel;
use framework\Page;
class SingleController extends Controller
{
	protected $user;

	function __construct()
	{
		parent::__construct();
		$this->user = new SingleModel();
	}
	//添加回复
	function addReply()
	{
		if (empty($_SESSION['username'])) {
			$this->notice('请登陆后再操作');
			exit;
		}
		if (empty($_POST['content'])) {
			$this->notice('回复内容不能为空');
			exit;
		}

		$isRepy = $this->user->replyAdd($_GET['id'] , $_SESSION['uid'] , $_POST['content']);
		if ($isRepy == false) {
			$this->notice('回复失败');
			exit;
		}

		//增加回帖数
		$this->user->addRreplyCount($_GET['id']);

		$this->notice('回复成功');
		exit;


	}
	//默认展示
	function index()
	{
		
		//要展示的主帖子信息
		if (empty($_GET['id'])) {
			$this->notice('这个文章被管理员吃掉了，去别的页面看看吧');
			exit;
		} else {
			$id = $_GET['id'];
		}

		//点击量增加
		$this->user->addHits($id);
		
		// 帖子与图片两表联查
		$details = $this->user->getDetails($id);
		if ($details == false) {
			$this->notice('这个文章被管理员吃掉了，去别的页面看看吧' , 'index.php?m=blog&a=index');
			exit;
		}
		$this->assign('details' , $details);

		//作者名字信息，名字和头像
		$author = $this->user->getAuthor();
		$this->assign('author' , $author);

		//要展示的帖子信息，一页4个
		if (empty($_GET['page'])) {
			$pageStart = 0;
		} else {
			$pageStart = ($_GET['page'] - 1)*4;
		}

		//回帖分页需要
		$replyCount = $this->user->getReplyCount($id);
		$page = new Page(4 , $replyCount);
		$page = $page->allPage();
		$this->assign('page' , $page);

		//回帖数量
		$this->assign('replyCount' , $replyCount);

		//回帖信息,两表联查出用户名和头像
		$reply = $this->user->getReply($id , $pageStart);
		$this->assign('reply' , $reply);

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

		$this->display('single.html');
	}
}
