<?php

namespace model;
use framework\Model;
class IndexModel extends Model
{
	function search($str)
	{
		$data['username'] = $this->field('username , picture')->table('blog_user')->where("username like '%$str%'")->select();
		$data['title'] = $this->field('id , title')->table('blog_details')->where("title like '%$str%' and isDel = 0 and first = 1")->select();
		$data['content'] = $this->field('id , content')->table('blog_details')->where("content like '%$str%' and isDel = 0 and first = 1")->select();
		$data['reply'] = $this->field('tid , content')->table('blog_details')->where("content like '%$str%' and isDel = 0 and first = 0")->select();
		return $data;
	}

	function getGalleryBig()
		{
			$data = $this->field('*')->table('blog_gallery')->order('pid desc')->limit('6')->select();
			return $data;
		}

	function getGallery()
		{
			$data = $this->field('*')->table('blog_gallery')->order('pid desc')->limit('8')->select();
			return $data;
		}

	function getDetailsThree()
		{
			$data = $this->field('*')->table('blog_details , blog_gallery')->where('blog_details.pid = blog_gallery.pid and blog_details.first = 1 and blog_details.isDel = 0')->limit('3')->order('addtime desc')->select();
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