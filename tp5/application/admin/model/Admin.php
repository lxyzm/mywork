<?php

namespace app\admin\model;
use think\Model;


class Admin extends Model
{
	

	//模型会自动对应一个数据表，规范是：
	//数据库前缀+当前的模型类名（不含命名空间）
	//定义数据库的完整名字
		protected $table = 'admin';
	//定义读取器
	//定义修改器
	
	protected function setPasswordAttr($value)
	{
			return md5($value);
	}

}

?>