<?php 
// 引入命名空间
namespace app\admin\controller;

use think\Db;
// 导入系统类
use think\Controller;

// 声明控制器
class Column extends Permit{
	// 后台首页方法

	public function index(){

		// 获取用户搜搜的内容

		$search = input("get.search");
		// 查询数据

		$list = Db::table("column")->order("sort DESC")->where("name like '%$search%'")->paginate(10,false,['query'=>request()->param()]);

		$tot = Db::table("column")->count();
		// 分配数据
		$this->assign("list",$list);
		$this->assign("menu",'sys');
		$this->assign("tot",$tot);
		// 加载页面

		return view();
	}

	// ajax添加数据

	public function ajax_add(){

		// 接受所有的请求

		$post = input("post.");

		// 插入数据

		if (Db::table('column')->insert($post)) {
			
			$data = [
				"code"=>200,
				"info"=>"添加成功",
			];
		}else{
			$data = [
				"code"=>400,
				"info"=>"添加失败",
			];
		}

		// echo json_encode($data);
		// return 会自动将数据转换成json
		return $data;


	}

	// 修改排序方法

	public function ajax_sort(){

		// 接受post提交数据

		$arr = input("post.");

		// 修改数据

		if (Db::table("column")->update($arr)) {
			$data = [
				"code"=>200,
				"info"=>"排序成功",
			];
		}else{
			$data = [
				"code"=>400,
				"info"=>"排序失败",
			];
		}

		return $data;

	}

}




 ?>




?>