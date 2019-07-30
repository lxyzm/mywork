<?php

namespace app\admin\controller;
use think\Controller;
use app\admin\model\User as UserModel; 
use think\Db;
use app\admin\Controller\Permit;

class User extends Permit
{
	public function index()
	{
		$search=input("get.search");
		$list = Db::table("user")->where('username','like',"%$search%")->whereOr('email','like',"%$search%")->whereOr('phone','like',"%$search%")->order('id','DESC')->paginate(5,false,['query'=>request()->param()]);
		$tot = Db::table("user")->where('username' ,'like' ,"%$search%")->whereOr('email' ,'like',"%$search%")->whereOr('phone','like',"%$search%")->count();
		
		$this->assign("list",$list);
		$this->assign("tot",$tot);
		return view();
	
	}
	
}


?>