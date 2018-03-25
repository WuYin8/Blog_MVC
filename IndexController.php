<?php

namespace controller;
use model\IndexModel;
class IndexController extends Controller
{
	protected $user;

	function __construct()
	{
		parent::__construct();
		$this->user = new IndexModel();
	}

	//搜索展示
	function search()
	{
		if (empty($_POST['searchStr']) && empty($_GET['searchStr'])) {
			$this->notice('搜索内容不得为空');
			exit;
		}
		if (empty($_POST['searchStr']) && !empty($_GET['searchStr'])) {
			$searchStr = $_GET['searchStr'];
		} else {
			$searchStr = $_POST['searchStr'];
		}
		
		//对用户名，铸铁标题，主贴内容，回复内容进行搜索
		$searchData = $this->user->search($searchStr);

		//用户名和照片
		if ($searchData['username'] == false) {
			$searchUsername = false;
		} else {
			foreach ($searchData['username'] as $k => $v) {
				$searchUsername[] = $v;
			}
		}
		
		$this->assign('searchUsername' , $searchUsername);

		// 标题和连接
		if ($searchData['title'] == false) {
			$searchTitle = false;
		} else {
			foreach ($searchData['title'] as $k => $v) {
				$searchTitle[] = $v;
			}
		}
		$this->assign('searchTitle' , $searchTitle);

		// 主贴和连接
		if ($searchData['content'] == false) {
			$searchContent = false;
		} else {
			foreach ($searchData['content'] as $k => $v) {
				$searchContent[] = $v;
			}
		}
		$this->assign('searchContent' , $searchContent);

		// 回帖与连接
		if ($searchData['reply'] == false) {
			$searchReply = false;
		} else {
			foreach ($searchData['reply'] as $k => $v) {
				$searchReply[] = $v;
			}
		}
		$this->assign('searchReply' , $searchReply);

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


		$this->display('search.html');
		exit;
	}

	function index()
	{
		//滚动画廊展示
		$galleryBig = $this->user->getGalleryBig();
		$this->assign('galleryBig' , $galleryBig);

		//画廊展示
		$gallery = $this->user->getGallery();
		$this->assign('gallery' , $gallery);

		//近期的发帖
		$detailsThree = $this->user->getDetailsThree();
		$this->assign('detailsThree' , $detailsThree);

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

		//什么都用写，代表显示app/view/index(控制器)/index(方法名字).html
		$this->display();
	}
}
