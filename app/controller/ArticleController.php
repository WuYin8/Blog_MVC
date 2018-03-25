<?php
namespace controller;
use \model\ArticleModel as AModel;
class ArticleController extends Controller
{

	function send()
	{
		$this->display();
	}
	function doSend()
	{
		$data['title'] = $_POST['title'];
		$data['content'] = $_POST['content'];
		$data['uid'] = 23;
		$arc= new AModel();
		
		//以后你要插入数据库或者查询，，如果你要调用table()  把完整的表名写上
		
		if ($arc->table('tb_article')->insert($data)) {
			$this->notice('发表成功');
		} else {
			$this->notice('发表失败');
		}
	}
}
/*
	其实就是路由的问题
	index.php?m=article&a=send
	article:对应的控制器
	send：对应的控制器下面的方法
 */