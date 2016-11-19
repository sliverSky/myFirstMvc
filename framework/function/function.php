<?php

   /**
   * 控制器调用函数C，在控制器函数中完成对model和view的调用
   * @param [type] $name   [description]类名
   * @param [type] $method [description]方法名
   */
  function C($name,$method)
  {
  	require_once('./libs/Controller/'.$name.'Controller.class.php');
  	//把字符串转换为可以执行的php语句
  	//eval('$obj= new '.$name.'Controller();$obj->'.$method.'(); ');
  	//写法二
  	$controller=$name.'Controller';
  	$obj=new $controller();
  	$obj->$method();
  }
  //C('test','show');
  /**
   * 这个是模型调用函数
   * @param [type] $name [description]类名
   */
  function M($name)
  {
  	# code...
  	require_once('./libs/Model/'.$name.'Model.class.php');
  	//eval('$obj=new '.$name.'Model();');
  	$model=$name.'Model';
  	$obj=new $model();
  	return $obj;
  }
  function V($name)
  {
  	# code...
  	require_once('./libs/View/'.$name.'View.class.php');
  	//eval('$obj=new '.$name.'View();');
  	$view=$name.'View';
    $obj=new $view();
  	return $obj;
  }
  /**
   * 对一些非法字符进行转义
   * addcslashes的作用是在字符串面前加上反斜杠，对里面的特殊字符进行转义
   * @param  [type] $str [description]
   * @return [type]      [description]
   */
  function daddslashes($str){
    return (!get_magic_quotes_gpc())?addslashes($str):$str;
  }
  /**
   * ORG函数
   * @param [type] $path   [description]
   * @param [type] $name   [description]
   * @param array  $params [description]
   */
    function ORG($path,$name,$params=array())
    {
    	require('./libs/ORG/'.$path.'/'.$name.'.class.php');
    	$obj=new $name();
    	if ($params) {
    		foreach ($params as $key => $value) {
    			$obj->$key=$value;
    		}
    	}
    	return $obj;
    }