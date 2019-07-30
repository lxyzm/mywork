<?php
namespace app\index\controller;

// 导入数据库类
use think\Db;
// 导入数系统类
use think\Controller;

class Index extends Controller
{
	public function _initialize(){    
		// 查询栏目
    	$column = Db::table("column")->order("sort DESC")->select();


    	// 分配数据

    	$this->assign("column",$column);
    }
    
	// 前台首页
    public function index()
    {

    	// 查询轮播图
    	$slider = Db::table("slider")->order("sort DESC")->select();

    	// 今日推荐文章
    	$article = Db::table("news")->order("id DESC")->find();

    	// 热门新闻

    	$hot = Db::table("news")->order("num DESC")->limit(5)->select();


    	// 最新发布新闻

    	$new = Db::table("news")->field("news.*,newtype.name")->join("newtype",'news.typeid = newtype.id')->order("time DESC")->limit(5)->select();


    	// 分配数据
    	$this->assign("current","首页");
		$this->assign("slider",$slider);
		$this->assign("article",$article);
		$this->assign("hot",$hot);
		$this->assign("new",$new);
		// 加载页面
    	return view();
    }

    // 分类页面

    public function category(){

    	// 接受分类的ID

    	$id = input("id");

    	// 查看分类名

    	$type = Db::table("newtype")->find($id);

    	// 查看热门文章

    	$hot = Db::table("news")->order("num desc")->limit(5)->select();

    	// 查看当前分类下的所有文章

    	$data = Db::table("news")->where("typeid = $id")->order("id DESC")->select();

    	// 分配数据
    	$this->assign("current","首页");
    	$this->assign("hot",$hot);
    	$this->assign("type",$type);
    	$this->assign("data",$data);
		// 加载页面
    	return view();
    }

    // 文章页面

    public function article(){

    	// 接受文章ID
    	$id = input("id");
		//dump($id);
    	// 通过文章查找ID
    	$article = Db::table("news")
    				->field("news.*,newtype.name")
    				->join("newtype",'news.typeid = newtype.id')
    				->where("news.id = $id")
    				->find();

    	// 获取热门文章
    	$hot = Db::table("news")
    				->order("num DESC")
    				->limit(5)
    				->select();

    	// 增加阅读量
    	$arr = [
    		"id"=>$id,
    		"num"=>$article['num']+1,
    	];
    	Db::table("news")->update($arr);

    	// 查询文章的相关推荐

    	$tuijian = Db::table("news")
    				->where("typeid = $article[typeid]")
    				->limit(8)
    				->select();

    	// 查询文章对应的评论

    	$comment = Db::table("comment")
    				->field("comment.*,user.img,user.username,user.nickname")
    				->join("user",'user.id = comment.uid')
    				->where("comment.nid = $id and comment.status=1")
    				->order("comment.id DESC")
    				->select();

    	// 分配数据

    	$this->assign("data",$article);
    	$this->assign("tuijian",$tuijian);
    	$this->assign("comment",$comment);
    	$this->assign("hot",$hot);
    	$this->assign("current","");

		// 加载页面
    	return view();

    }


    // 关于我

    public function about(){

    	return view();
    }

    public function reg(){
    	$data = input("post.");
    	if ($data['phone'] && $data['pass'] && $data['repass'] && $data['username']) {
			if ($data['pass']===$data['repass']) {
    				$arr=[
    					"phone"=>$data['phone'],
    					"password"=>md5($data['repass']),
    					"time"=>time(),
						"username"=>$data['username'],
    					"status"=>0

    				];

    				if (Db::table("user")->insert($arr)) {
    					# code...、
    					$this->success("注册成功");

    				}else{
    					$this->error("注册失败");

    				}
    			}else{
    				$this->error("两次密码不一致");

    			}
    	}else{
    		$this->error("请输入字段");
    	}
    }

    public function check(){
    	$data = input("post.");

    	// 获取关系1
		//dump($data);

    	$user = Db::table("user")
    				->where("username = '$data[username]'")
    				->whereOr("phone = '$data[username]'")
    				->whereOr("email = '$data[password]'")
    				->find();
		dump($user);
    	if ($user) {
    		# code...
    		// 判断密码是否成功

    		if ($user['password'] == md5($data['password'])) {
    			# code...
    			session("username",$user['id']);
    			session("user_id",$user);
    			$this->success("登录成功");
    		}else{
    			$this->error("登录失败");

    		}
    	}else{
    		$this->error("登录失败");
    	}

    }

}
