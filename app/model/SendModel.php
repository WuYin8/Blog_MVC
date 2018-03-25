<?php

namespace model;
use framework\Model;
class SendModel extends Model
{
	function isAdmin($name)
	{
		$data = $this->field('undertype')->table('blog_user')->where("username = '$name'")->select();
		return $data[0]['undertype'];
	}

	function send($title , $content)
	{
		$num = $this->field('pid')->table('blog_gallery')->select();
		foreach ($num as $key => $value) {
			foreach ($value as $v) {
				$num2[] = $v;
			}
		}
		$num2 = join('' , $num2);
		$pid = substr(str_shuffle($num2) , 0 , 1);
		$data = $this->table('blog_details')->insert(['authorid'=>$_SESSION['uid'] , 'first'=>1 , 'tid'=>0 , 'addtime'=>time() , 'title'=>$title , 'content'=>$content , 'pid'=>$pid]);
		return $data;
	}

	function getWebMsg($name)
	{
		$data = $this->table('blog_msg')->field('content')->where("name = '$name'")->select();
		return $data[0]['content'];
	}	

	function getLink()
	{
		return $this->table('blog_link')->field('name , url , description')->select();
	}	
}