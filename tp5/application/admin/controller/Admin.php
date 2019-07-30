<?php

namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\Admin as Adminodel;
use app\admin\Controller\Permit;

class Admin extends Permit
{
	//使用Admin模块
	
	public function index()
	{
		
		//模版引擎渲染
		$search=input("get.search");
		//从数据库中读文件
		$list  = Db::table('admin')->where('username','like',"%$search%")->order("id",'desc')->paginate(5,false,['query'=>request()->param()]);
		$tot = Db::table('admin')->where('username','like',"%$search%")->count();
		
		
		//分配给模版页面extends Controller
		
		$this->assign('list',$list);
		$this ->assign('tot',$tot);
		$this->assign("menu","user");
		return $this->fetch();
	}
	//处理用户添加页面
	public function ajax_username()
	{
	
		

		$username = input('get.username');
		$data = Db::table("admin")->where("username",$username)->select();
		if($data)
		{
			return 1;
			
		}else
		{
			return 0;
		}
		
	}
	public function ajax_add()
	{
		#dump(11);
		$sucess_data =[
							"code"=>200,
							"info"=>"添加成功",
						
						
						];
		$fail_data = [
							"code"=>400,
							"info"=>"添加失败",
						];	
					
		$post = input("post.");
		if($post['username'])
		{
			if($post['password'])
			{
				if($post['password']==$post['repassword'])
				{
					//使用Admin模块	
					$admin = new Adminodel;
					$admin->username=$post['username'];
					$admin->password=$post['password'];
					$admin->status=$post['status'];
					$admin->time=time();
					if($admin->save())
					{
						
						echo json_encode($sucess_data);
						
						
					}else{
						echo json_encode($fail_data);
					}
					
				}else
				{
					echo json_encode($fail_data);
				}
			}else
			{
				echo json_encode($fail_data);
			}
			
		}else
		{
			echo json_encode($fail_data);
		}
		
	}
	
	
	//删除数据
	public function ajax_del_all()
	{
		$id = input("get.str");
		$admin = Adminodel::get($id);
		if($admin)
		{
			$admin->delete();
			echo 1;
		}else
		{
			echo 0;
		}
		
	}
	public function ajax_find()
	{
		$id = input('get.id');
		$data = Adminodel::get($id);
		$this->assign("data",$data);
		#dump($data);
		
		return view();
		
	}
	
	public function ajax_save()
	{
		
	

		
		if(input("post.password") || input("post.repassword"))
		{
			
			if(input("post.password")===input("post.repassword"))
			{
				$admin = new Adminodel;
				$admin->id = input("post.id");
				$admin->status = input("post.status");
				$admin->password = input("post.password");
				if($admin->isUpdate()->save())
				{
					$data = [
					"code"=>200,
					"info"=>"修改成功",
					
					];
					
				}else
				{
					$data = [
					"code"=>400,
					"info"=>"修改失败",
					];
					
				}
				
				
			}else
			{
				$data = [
						"code"=>400,
						"info"=>"2次密码不一致",
				];
				
			}
			
			
		}else
		{
			$arr = [
					"code"=>400,
					"info"=>"密码不能为空",
			
			];
		}
		
		#dump($data);
		echo json_decode($data);
		exit();
		
		
	}
	//修改状态
	public function ajax_status()
	{
		$data = input("get.");
	
		if(Db::table("admin")->update($data))
		{
			return 1;
		}else
		{
			return 0;
		}
	
	}
}
?>
