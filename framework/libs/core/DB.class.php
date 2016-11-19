<?php
    /**
    * 数据库操作的工厂类
    */
    class DB//类名在php中是一个全局变量DB::$$db DB::方法()
    {
        public static $db;	//保存实例化对象
    	/**
    	 * 初始化对象，连接数据库
    	 * @param  [type] $dbtype [description]
    	 * @param  [type] $config [description]
    	 * @return [type]         [description]
    	 */
    	public static function init($dbtype,$config)
    	{
    		self::$db=new $dbtype;
    		self::$db->connect($config);
    	}
    	/**
    	 * 执行sql语句
    	 * @param  [type] $sql [description]
    	 * @return [type]      [description]
    	 */
    	public static function  query($sql)
    	{
    		return self::$db->query($sql);
    	}
    	/**
    	 * 或许所有的数据行
    	 * @param  [type] $sql [description]
    	 * @return [type]      [description]数据行数组
    	 */
    	public static function findAll($sql)
    	{
    		$res=self::$db->query($sql);
    		return self::$db->findAll($res);
    	}
    	/**
    	 * 得到结果集中的一条数据
    	 * @param  [type] $sql [description]
    	 * @return [type]      [description]
    	 */
    	public static function findOne($sql)
    	{
    		$res=self::$db->query($sql);
    		return self::$db->findOne($res);
    	}
    	/**
    	 * 返回指定行的数据
    	 * @param  [type]  $sql   [description]
    	 * @param  integer $row   [description]
    	 * @param  integer $filed [description]
    	 * @return [type]         [description]
    	 */
    	public static function findResult($sql,$row=0,$filed=0)
    	{
    		$res=self::$db->query($sql);
    		return self::$db->findResult($res,$row,$filed);
    	}
    	/**
    	 * 插入数据
    	 * @param  [type] $table [description]
    	 * @param  [type] $arr   [description]
    	 * @return [type]        [description]
    	 */
    	public static function insert($table,$arr)
    	{
    		return self::$db->insert($table,$arr);
    	}
    	/**
    	 * 更新数据
    	 * @param  [type] $table [description]
    	 * @param  [type] $arr   [description]
    	 * @param  [type] $where [description]
    	 * @return [type]        [description]
    	 */
    	public static function update($table,$arr,$where)
    	{
    		return self::$db->update($table,$arr,$where);
    	}
    	public static function delete($table,$where)
    	{
    		return self::$db->delete($table,$where);
    	}
    }