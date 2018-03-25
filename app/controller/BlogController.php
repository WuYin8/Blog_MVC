<?php

namespace controller;
use model\BlogModel;
use framework\Page;
class BlogController extends Controller
{
	protected $user;

	function __construct()
	{
		parent::__construct();
		$this->user = new BlogModel();
	}

	function index()
	{
		//分页需要
		$totalCount = $this->user->getTotalCount();
		$page = new Page(3 , $totalCount);
		$page = $page->allPage();
		$this->assign('page' , $page);

		//要展示的帖子信息，一页三个
		if (empty($_GET['page'])) {
			$pageStart = 0;
		} else {
			$pageStart = ($_GET['page'] - 1)*3;
		}
		// 帖子与图片两表联查
		$details = $this->user->getDetails($pageStart);
		$this->assign('details' , $details);

		//作者名字
		$author = $this->user->getAuthor();
		$this->assign('author' , $author);

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

		$this->display('blog.html');
	}
}
