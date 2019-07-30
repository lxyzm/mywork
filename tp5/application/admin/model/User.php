<?php
namespace app\admin\model;
use think\Model;

class User extends Model
{
	//自定义表名
	protected $table="User";
	//定义修改器
	protected function setPasswordAttr($value)
	{
		return md5($value);
	}
}



?>