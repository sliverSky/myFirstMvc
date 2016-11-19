<?php
    /**
    * 从数据库中存取数据
    */
    class adminModel
    {
    	//定义表名
    	public $_table='admin';//定义表名
    	//通过用户名取用户信息
    	function findOne_by_username($username)
    	{
    		$sql="SELECT * FROM {$this->_table} WHERE username="."'".$username."'";
    		return DB::findOne($sql);
    	}
    }