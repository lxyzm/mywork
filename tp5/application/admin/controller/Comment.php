<?php

namespace app\admin\controller;


use think\Controller;

use app\admin\Controller\Permit;
use think\Db;

class Comment extends Permit{
		public function index()
		{
			$data = Db::table("comment")
					->field("comment.*,news.title,news.img,user.username")
					->join("news","comment.nid=news.id")
					->join("user","comment.uid=user.id")
					->order("comment.id","DESC")
					->paginate(3,false,['query'=>request()->param()]);
					
			$tot = Db::table("comment")
					->field("comment.*,news.title,news.img,user.username")
					->join("news",'comment.nid = news.id')
					->join("user",'comment.uid = user.id')
					->order("comment.id","DESC")
					->count();
					
		 $this->assign("data",$data);
		 $this->assign("tot",$tot);
		 $this->assign("menu",'news');
		 
		 return view();
		}
		
		public function ajax_status()
		{
			$data = input("get.*");
			if(Db::table("comment")->update($data))
			{
				$arr = [
				"code"=>200,
				"info"=>"修改成功",
				
				];
			}else
			{
				$arr = [
				"code"=>400,
				"info"=>"修改失败",
				
				];
			}
			return $arr;
			
			
			
			
			
			
		}
}




?>