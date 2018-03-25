<?php

namespace model;
use framework\Model;
class SingleModel extends Model
{
	function getDetails($id)
	{
		$data = $this->field('*')->table('blog_details , blog_gallery')->where("blog_details.pid = blog_gallery.pid and blog_details.id = '$id' and blog_details.first = 1 and blog_details.isDel = 0")->select();
		return $data;
	}

	function getAuthor()
	{
		$data = $this->field('username , picture')->table('blog_user')->where('undertype = 1')->select();
		return $data[0];
	}

	function addHits($id)
	{
		$hits = $this->field('hits')->table('blog_details')->where("blog_details.id = '$id'")->select();
		$hits = $hits[0]['hits'];
		$hits++;
		$this->table('blog_details')->where("blog_details.id = '$id'")->update(['hits'=>$hits]);
	}

	function getReply($id , $pageStart)
	{
		$data = $this->field('*')->table('blog_details , blog_user')->where("blog_details.authorid = blog_user.uid and blog_details.tid = '$id' and  blog_details.first = 0 and blog_details.isDel = 0")->limit($pageStart . ', 4')->order('addtime desc')->select();
		return $data;
	}
	
	function getReplyCount($id)
	{
		$data = $this->count('id' , 'blog_details' , "tid = '$id' and isDel = 0");
		return $data;
	}

	function addRreplyCount($id)
	{
		$data = $this->count('id' , 'blog_details' , "tid = '$id' and isDel = 0");
		// $data++;
		$this->table('blog_details')->where("id = '$id'")->update(['replycount'=>$data]);
	}

	function replyAdd($id , $authorid , $content)
	{
		$data = $this->table('blog_details')->insert(['authorid'=>$authorid , 'first'=>0 , 'tid'=>$id , 'addtime'=>time() , 'title'=>'' , 'content'=>$content]);
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