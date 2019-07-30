<?php


namespace app\admin\controller;
use think\Controller;
use app\admin\model\Newtype as AdminNewtype;
use think\Db;
use app\admin\Controller\Permit;

class Newtype extends Permit
{
	public function index()
	{
		$list = Db::table("newtype")->order('id','DESC')->select();
		$this->assign("list",$list);
		$this->assign("menu",'news');
		return view();
		
	}
	
	public function ajax_add()
	{
		$data = input("post.");
		$News = new AdminNewtype;
		$News->name =$data['name'];
		if($News->save())
		{
			$arr = [
			'code'=>200,
			'info'=>'添加成功',
			
			];
		}else
		{
			$arr = [
			'code'=>400,
			'info'=>'添加失败',
			
			];
			
		}
		return $arr;
		
	}
}




?>