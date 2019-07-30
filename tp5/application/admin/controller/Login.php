<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;


class Login extends Controller{
	
	public function index()
	{
		return view();
	}
	
	public function check()
	{
		$username = input("post.username");
		$password = input("post.password");
		$code = input("post.code");
		
		if($username)
		{
			if($password){
				
			
				
				if($code)
				{
					//验证验证码
					if(captcha_check($code))
					{
						$where = ['username'=>$username,'password'=>md5($password),"status"=>0];
						
						$data = Db::table('admin')->where($where)->find();
						
						if($data)
						{
							//把登录信息存储在session中
							session("username",$data['username']);
							session("user_id",$data['id']);
							//更新最后一次登录信息
							
							$arr = [
							"id"=>$data['id'],
							"logintime"=>time()
							
							];
							
							Db::table("admin")->update($arr);
							$this->success("登录成功",'index/index');
						}else
						{
							$this->error("登录失败");
						}
					}else
					{
						$this->error("验证码错误");
					}
					
					
					
				}else
				{
					$this->error("请输入验证码");
				}
			}else
			{
			$this->error("请输入密码");
			}
		}else
		{
		$this->error("请输入用户名");
		}
	
	
	}

		public function logout(){
		session(null);
		$this->success("退出成功","Login/index");

	}

}
?>