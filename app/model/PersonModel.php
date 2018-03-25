<?php

namespace model;
use framework\Model;
class PersonModel extends Model
{
	function getInfo($name)
	{
		$data = $this->table('blog_user')->field("*")->where("username = '$name'")->select();
		return $data[0];
	}

	function nameExists($str)
	{
		$data = $this->field('*')->table('blog_user')->where("username = '$str'")->select();
		return $data;
	}

	function phoneExists($str)
	{
		$data = $this->field('*')->table('blog_user')->where("phone = '$str'")->select();
		return $data;
	}

	function changeInfo($arr , $username)
	{
		$data = $this->table('blog_user')->where("username = '$username' ")->update($arr);
		// var_dump($this->sql);
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