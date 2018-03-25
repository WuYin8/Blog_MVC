<?php

namespace model;
use framework\Model;
class AdminModel extends Model
{
	function nameEixsts($name)
	{
		$data = $this->where("username = '$name'")->table('blog_user')->field('username')->select();
		return $data;
	}

	function isAdmin($name)
	{
		$data = $this->where("username = '$name'")->table('blog_user')->field('undertype')->select();
		return $data[0]['undertype'];
	}

	function pwdAdmin($name)
	{
		$data = $this->where("username = '$name'")->table('blog_user')->field('password')->select();
		return $data[0]['password'];
	}

	function getAdminInfo($name)
	{
		$data = $this->where("username = '$name'")->table('blog_user')->field('uid , picture , undertype')->select();
		return $data[0];
	}

	function getUsers($pageStart)
	{
		$data = $this->field('*')->table('blog_user')->where("allowlogin = 0")->limit($pageStart . ', 10')->select();
		return $data;
	}

	function lockUser($data , $dataId)
	{
		$this->table('blog_user')->where("uid in ($dataId)")->update($data);
	}

	function getLockUsers($pageStart)
	{
		$data = $this->field('*')->table('blog_user')->where("allowlogin = 1")->limit($pageStart . ', 10')->select();
		return $data;
	}

	function UserDelete($id)
	{
		$this->table('blog_user')->where("uid = '$id'")->delete();
	}

	function getContents($pageStart)
	{
		$data = $this->field('*')->table('blog_details')->where("first = 1 and isDel = 0")->order('addtime desc')->limit($pageStart . ', 6')->select();
		return $data;
	}

	function lockContent($data , $dataId)
	{
		$this->table('blog_details')->where("id in ($dataId)")->update($data);
	}

	function getLockContent()
	{
		$data = $this->field('*')->table('blog_details')->where("first = 1 and isDel = 1")->order('addtime desc')->select();
		return $data;
	}

	function ContentDelete($id)
	{
		$this->table('blog_details')->where("id = '$id'")->delete();
	}


	function getReplys($pageStart)
	{
		$data = $this->field('*')->table('blog_details')->where("first = 0 and isDel = 0")->order('addtime desc')->limit($pageStart . ', 6')->select();
		return $data;
	}

	function lockReply($data , $dataId)
	{
		$this->table('blog_details')->where("id in ($dataId)")->update($data);
	}

	function getLockReply()
	{
		$data = $this->field('*')->table('blog_details')->where("first = 0 and isDel = 1")->order('addtime desc')->select();
		return $data;
	}

	function ReplyDelete($id)
	{
		$this->table('blog_details')->where("id = '$id'")->delete();
	}

	function userTotalCount()
	{
		$data = $this->count('id' , 'blog_user' , 'allowlogin=0');
		return $data;
	}


	function contentTotalCount()
	{
		$data = $this->count('id' , 'blog_details' , 'first = 1 and isDel = 0');
		return $data;
	}

	function contentDelCount()
	{
		$data = $this->count('id' , 'blog_details' , 'first = 1 and isDel = 1');
		return $data;
	}

	function replyTotalCount()
	{
		$data = $this->count('id' , 'blog_details' , 'first = 0 and isDel = 0');
		return $data;
	}

	function replyDelCount()
	{
		$data = $this->count('id' , 'blog_details' , 'first = 0 and isDel = 1');
		return $data;
	}

	function haveReply($id)
	{
		return $this->field('id')->table('blog_details')->where("tid = $id")->select();
	}
}