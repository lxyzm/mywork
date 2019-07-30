<?php

namespace app\admin\controller;
use think\Controller;
use app\admin\Controller\Permit;

class System extends Permit
{
	public function  index()
	{
		$this->assign("menu","sys");
		return view();
	}
	
	public function check()
	{
		$data = input("post.");
		//html声明的
		$config = config("webconfig");
		//dump($config);
		
		$arr = array_merge($config,$data);
		$file = request()->file("LOGO");
		if($file)
		{
			$info = $file->validate(['ext'=>'png,jpg,gif'])->move(ROOT_PATH.'public/upload/');
			if($info)
			{
				$arr['LOGO']=$info->getSaveName();
			}else
			{
				$this->error($file->getError());
			}
		}
		
		$str = "<?php  return ".var_export($arr,true).";?>";
		// 将字符串内容写入到webConfig配置文件中
		if(file_put_contents("../application/extra/webconfig.php",$str)){
			
			if($file){
				unlink("./upload/".$config['LOGO']);
			}
			$this->redirect("system/index");
			
		}else{
			
			$this->redirect("system/index");
			
		}
		
		
	}

	
}




?>