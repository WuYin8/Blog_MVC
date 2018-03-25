<?php

namespace model;
use framework\Model;
class BlogModel extends Model
{
	function getDetails($pageStart)
	{
		$data = $this->field('*')->table('blog_details , blog_gallery')->where('blog_details.pid = blog_gallery.pid and blog_details.isDel = 0 and first = 1')->limit($pageStart . ', 3')->order('addtime desc')->select();
		return $data;
	}

	function getAuthor()
	{
		$data = $this->field('username')->table('blog_user')->where('undertype = 1')->select();
		return $data[0]['username'];
	}
	
	function getTotalCount()
	{
		$data = $this->count('id' , 'blog_details' , 'first = 1 and isDel = 0');
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