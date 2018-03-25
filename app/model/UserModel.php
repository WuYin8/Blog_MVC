<?php

namespace model;
use framework\Model;
class UserModel extends Model
{
	function nameExists($name)
	{
		return $this->field('username')->table('blog_user')->where("username = '$name'")->select();
	}

	function nameDel($name)
	{
		$data = $this->field('allowlogin')->table('blog_user')->where("username = '$name'")->select();
		return $data[0]['allowlogin'];
	}

	function loginPwd($username)
	{
		$data = $this->field('password')->table('blog_user')->where("username = '$username'")->select();
		return $data[0]['password'];
	}

	function lasttime($name)
	{
		$this->table('blog_user')->where("username = '$name'")->update(['lasttime'=>time()]);
	}

	function getUid($name)
	{
		$data = $this->field('uid')->table('blog_user')->where("username = '$name'")->select();
		return $data[0]['uid'];
	}

	function getPic($name)
	{
		$data = $this->field('picture')->table('blog_user')->where("username = '$name'")->select();
		return $data[0]['picture'];
	}

	function phoneExists($name)
	{
		return $this->field('phone')->table('blog_user')->where("phone = '$name'")->select();
	}

	function register($registerName , $registerPwd , $phone)
	{
		if ($_SERVER['REMOTE_ADDR']=='::1') {
			$regIp = '127.0.0.1';
		} else {
			$regIp = $_SERVER['REMOTE_ADDR'];
		} 

		$regIp = ip2long($regIp);
		$this->table('blog_user')->insert(['username'=>$registerName , 'password'=>md5($registerPwd) , 'phone'=>$phone , 'undertype'=>0 , 'regtime'=>time() , 'lasttime'=>time() , 'regip'=>$regIp]);
		
	}
}