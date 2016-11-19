<?php
    /**
    * 数据库操作函数
    */
    class mysql
    {

    	/**
    	 * mysql报错函数
    	 * @param  [type] $error [description]
    	 * @return [type]        [description]
    	 */
    	function err($error){
    		die("对不起，数据库连接失败，错误原因是：".$error);
    	}
    	/**
    	 * 数据库连接函数
    	 * @param  [type] $config [description]
    	 * @return [type]         [description]
    	 */
    	function connect($config)
    	{
            //把数组拆分成变量
    		extract($config);
    		if (!$con=mysql_connect($dbhost,$dbuser,$dbpsw)) {
    			# code...
    			$this->err(mysql_error());
    		}
    		if (!mysql_select_db($dbname,$con)) {
    			# code...
    			$this->err(mysql_error());
    		}
    		mysql_query("SET NAMES".$dbcharset);
    	}
    	/**
    	 * mysql执行函数
    	 * @param  [type] $sql [description]
    	 * @return [type]      [description]
    	 */
    	function query($sql)
    	{
    		if(!$res=mysql_query($sql)){
    			$this->err($sql."</br>".mysql_error());
    		}else{
    			return $res;
    		}
    	}
    	/**
    	 * 根据结果集返回所有的结果
    	 * @param  [type] $res [description]
    	 * @return [type]      [description]
    	 */
    	function findAll($res)
    	{
    		while ($rs=mysql_fetch_array($res,MYSQL_ASSOC)) {
    			$list[]=$rs;
    		}
    		return isset($list)?$list:"";
    	}
    	/**
    	 * 根据结果集返回第一条记录
    	 * @param  [type] $res [description]
    	 * @return [type]      [description]
    	 */
    	function findOne($res)
    	{
    		$rs=mysql_fetch_array($res,MYSQL_ASSOC);
    		return $rs?$rs:"";
    	}
    	/**
    	 * 返回指定行的指定的字段的值
    	 * @param  [type]  $res   [description]结果集
    	 * @param  integer $row   [description]行数
    	 * @param  integer $field [description]范围
    	 * @return [type]         [description]
    	 */
    	function findResult($res,$row=0,$field=0)
    	{
    		$rs=mysql_result($res, $row,$field);
    		return $rs;
    	}
    	/**
    	 * 插入函数
    	 * @param  [type] $table [description]表名
    	 * @param  [type] $arr   [description]数组
    	 * @return [type]        [description]
    	 */
    	function insert($table,$arr)
    	{
    		foreach ($arr as $key => $value) {
    			$value=mysql_real_escape_string($value);
    			$keysArr[]="`".$key."`";
    			$valsArr[]="'".$value."'";
    		}
    		$key=join(",",$keysArr);
    		$val=join(",",$valsArr);
            if ($table=='news') {
                $time=time();
                $key=$key.","."`".'time'."`";
                $val=$val.","."'".$time."'";
            }
    		//$sql="INSERT INTO ".$table." (".$key." ) VALUES (".$val.")";
    		$sql="INSERT INTO "."`".$table."`"." (" .$key.")"."VALUES"."(".$val.")";
    		$this->query($sql);
    		return mysql_insert_id();
    	}

    	//update{$table} set 字段=字段值,字段=字段值…… where
    	/**
    	 * 更新数据表函数
    	 * @param  [type] $table [description]
    	 * @param  [type] $arr   [description]
    	 * @param  [type] $where [description]
    	 * @return [type]        [description]返回收到影响的行id
    	 */
    	function update($table,$arr,$where=null)
    	{
    		foreach ($arr as $key => $value) {
    			$value=mysql_real_escape_string($value);
    			$keyAndvalueArr[]="`".$key."`='".$value."'";
    		}
    		$val=join(",",$keyAndvalueArr);
    		$sql="UPDATE {$table} SET {$val}".($where==null?null:"WHERE id=".$where);
    		$this->query($sql);
    		return mysql_affected_rows();
    	}
    	function delete($table,$where)
    	{
    		$sql="DELETE FROM ".$table." WHERE id=".$where;
    		$this->query($sql);
    		return mysql_affected_rows();
    	}
    }