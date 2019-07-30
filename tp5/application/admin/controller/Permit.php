<?php

namespace app\admin\controller;


use think\Controller;


class Permit extends Controller
{
		public function _initialize()
		{
			if(session("username") && session("user_id"))
			{
				//$this->redirect('index/index');
				
			}else
			{
				$this->error("请登录","Login/index");
			}
		}
	
	
}


?>