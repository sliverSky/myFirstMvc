 <?php
    //框架的启动引擎
    $currentdir=dirname(__FILE__);
    include_once('include.list.php');
    foreach ($path as  $value) {
    	include_once($currentdir.'/'.$value);
    }
    /**
    * 
    */
    class PC
    {
    	public static $controller;
    	public static $method;
    	private static $config;
    	private static function init_db()
    	{
    		DB::init('mysql',self::$config['dbconfig']);
    	}
        /**
         * 初始化视图模板
         * @return [type] [description]
         */
    	private static function init_view()
    	{
    		VIEW::init('Smarty',self::$config['viewconfig']);
    	}
    	/**
    	 * 初始化控制器
    	 * 如果没有传值，那么给它一个默认值'index'
    	 * @return [type] [description]
    	 */
    	private static function init_controller()
    	{
    		self::$controller=isset($_GET['controller'])?daddslashes($_GET['controller']):'index';
    	}
    	private static function init_method()
    	{
    		self::$method=isset($_GET['method'])?daddslashes($_GET['method']):'index';
    	}
    	public static function run($config)
    	{
    		self::$config=$config;
    		self::init_db();
    		self::init_view();
    		self::init_controller();
    		self::init_method();
    		C(self::$controller,self::$method);
    	}
    }