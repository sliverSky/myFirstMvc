<?php
    /**
    * 
    */
    class VIEW
    {
        public static $view;
        /**
         * 对视图引擎进行配置
         * @param  [type] $viewtype [description]
         * @param  [type] $config   [description]
         * @return [type]           [description]
         */
        public static function init($viewtype,$config)
        {
        	self::$view=new $viewtype;
        	/*$smarty=new Smarty();
        	$smarty->left_delimiter=$config['left_delimiter'];*/
        	foreach ($config as $key => $value) {
        		self::$view->$key=$value;
        	}
        }
        /**
         * 数据载入
         * @param  [type] $data [description]
         * @return [type]       [description]
         */
        public static function assign($data)
        {
        	foreach ($data as $key => $value) {
        		self::$view->assign($key,$value);
        	}
        }
        /**
         * 数据模板
         * @param  [type] $template [description]
         * @return [type]           [description]
         */
        public static function display($template)
        {
        	self::$view->display($template);
        }
    }