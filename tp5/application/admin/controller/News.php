<?php

namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\News as AdminNews;
use app\admin\Controller\Permit;
	
class News extends Permit
{
	public function index()
	{
		$typeid = input("get.typeid");
		$search = input("get.search");
		$sort = input("get.sort");
		
		
		$where =[];
		if($typeid)
		{
			$where['news.typeid']= $typeid;
			
		}
		switch($sort)
		{
			case 0:
				$str = "news.id";
				break;
			
			case 1:
				$str  = "news.num";
				break;
			case 2:
				$str = "news.zannum";
				break;
				
			case 3:
				$str  = "news.shounum";
				break;
			
			default:
				$str ="news.id";
				break;
			
			
		}
		$type=Db::table("newtype")->select();
		$list=  Db::table("news")
				->where($where)
				->where("news.title",'like',"%$search%")
				->field("news.*,newtype.name")
				->join("newtype","newtype.id = news.typeid")
				->order($str)
				->paginate(3,false,['query'=>request()->param()]);
				
		$tot = Db::table("news")
				->where($where)
				->where("news.title",'like',"%$search%")
				->join("newtype","newtype.id = news.typeid")
				->count();
		
		$this->assign("tot",$tot);
		$this->assign("list",$list);
		$this->assign("type",$type);
		$this->assign("sort",$sort);
		$this->assign("typeid",$typeid);
		$this->assign("menu",$sort);
		return view();
		
		
		
		
	}
	
	public function add()
	{
		
		$newtype = Db::table("newtype")->select();
		$this->assign("data",$newtype);
		$this->assign("menu",'news');
		return view();
		
	}
	public function upload()
	{
		//获取用户上传的数据
		$file = request()->file("Filedata");
		//dump($file);
		if($file)
		{
			$info = $file->validate(['ext'=>'jpg,png,gif'])->move(ROOT_PATH.'/public/upload/tmp');
			//dump($info);
			
			if($info)
			{
				
				
				return  $info->getSaveName();
			}else
			{
				return false;
			}
		}else
		{
			return false;
		}
		
	}
	public function insert()
	{
		$data = input("post.");
		dump($data);
		$data['time']=time();
		//dump($data);
		//插入数据
		if(AdminNews::create($data))
		{
			//图片移动
			$tmp = "./upload/tmp/".$data['img'];
			$new = "./upload/news/".$data['img'];
			
			$dir = dirname($new);
			dump($dir);
			if(!file_exists($dir))
			{
				mkdir($dir);
			}
			copy($tmp,$new);
			$this->redirect("news/index");
		}else
		{
			$this->redirect("news/add");
		}
		
		
	}
}

?>