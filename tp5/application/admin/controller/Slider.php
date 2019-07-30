<?php 
// 引入命名空间
namespace app\admin\controller;

// 导入系统类
use think\Controller;
// 导入系统数据库类

use think\Db;

// 声明控制器
class Slider extends Permit{
	// 后台首页方法

	public function index(){

		// 接收搜搜的内容

		$search = input("get.search");
		// 查询轮播图数据

		$list = Db::table("slider")->where("name like '%$search%'")->order("sort desc")->paginate(2,false,['query'=>request()->param()]);
		$tot = Db::table("slider")->count();

		// 分配数据
		$this->assign("list",$list);
		$this->assign("tot",$tot);
		// 分配当前菜单
		$this->assign("menu",'sys');
		// 加载页面
		return view();
	}

	// 添加轮播图

	public function insert(){

		// 接收所有的post请求

		$data = input("post.");

		// 处理文件上传
		$file = request()->file("img");

		if ($file) {
			// 开始上传文件的操作

			$info = $file->move(ROOT_PATH.'public/upload/slider/');
			
			// 判断是否上传成功

			if ($info) {
				# code...

				$img=$info->getSaveName();
			}else{

				$this->error($file->getError());
			}
		}

		// 将图片追加到data数组中

		$data['img'] = $img;

		// 如何插入数据

		if (Db::table("slider")->insert($data)) {
			
			$this->redirect("slider/index");
		}else{
			$this->error("添加轮播图失败");

		}
	}

	// 无刷新删除

	public function ajax_del(){
		// 接受id

		$id = input("get.id");

		// 先查询数据

		$slider = Db::table("slider")->find($id);

		// 删除数据

		if (Db::table("Slider")->delete($id)) {

			unlink("./upload/slider/".$slider['img']);
			# code...
			$data = [
				"code"=>200,
				"info"=>'删除成功',
			];	
		}else{
			$data = [
				"code"=>400,
				"info"=>'删除失败',
			];	
		}

		// 使用return直接返回的json对象

		// echo json_encode 返回的是字符串
		// echo json_encode($data);
		return $data;
	}

	// ajax批量删除

	public function ajax_del_all(){

		// 接受ID字符串

		$idStr = input("get.idStr");

		// 接受img字符串

		$imgStr	 = input("get.imgStr");


		$imgArr = explode(',', $imgStr);



		// 删除对应数据

		if (Db::table("slider")->delete($idStr)) {

			// 将数组遍历 获取数组中每一个
			foreach ($imgArr as $key => $value) {
				unlink("./upload/slider/".$value);
			}

			echo 1;
		}else{
			echo 0;
		}

	}

	// ajax获取修改页面

	public function ajax_find(){

		// 接收id

		$id = input("get.id");

		// 通过ID获取数据

		$data = Db::table("Slider")->find($id);

		// 分配数据
		$this->assign("data",$data);

		// 加载页面
		return view();
	}

	// 修改轮播图的方法

	public function save(){

		// 接受post提交的数据


		$post = input("post.");

		$oldImg = $post['oldimg'];
		
		unset($post['oldimg']);


		// 判断用户是否修改图片

		$file = request()->file("img");

		// 判断是否修改图片

		if ($file) {
			// 上次图片
			$info = $file->move(ROOT_PATH.'public/upload/slider/');
			
			// 判断是否上传成功
			if ($info) {
				
				$img=$info->getSaveName();

				$post['img'] = $img;
			
			}else{
				$this->error($file->getError());
			}
		}

		// 更新数据哭

		if (Db::table("Slider")->update($post)) {
			# code...
			// 如果上传图片成功
			if ($file && $info) {
				unlink('./upload/slider/'.$oldImg);
			}
			$this->success("修改数据成功");

		}else{
			$this->error("修改数据失败");
		}
	}
}




 ?>