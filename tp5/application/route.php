<?php
use think\Route;
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------



Route::rule('username/','admin/admin/ajax_username');
Route::rule('find/','admin/admin/ajax_find');
Route::rule('del/','admin/admin/ajax_del_all');
Route::rule('add/','admin/admin/ajax_add');
Route::rule('status/','admin/admin/ajax_status');
Route::rule('save/','admin/admin/ajax_save');
Route::rule('Newsadd/','admin/newtype/ajax_add');
Route::rule('upload/','admin/news/upload');
Route::rule('c_status/',"admin/comment/ajax_status");


?>
