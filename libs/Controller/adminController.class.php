<?php
    /**
    * 
    */
    class adminController
    {
        public $auth='';
    	function test()
    	{
    		echo "hello";
    	}
        /**
         * 判断当前状况
         */
        public function __construct()
        {
            $authobj=M('auth');
            $this->auth=$authobj->getauth();
            //如果不是登录页也还没有登录，那么跳转到登录页
            if (!empty($this->auth)&&(PC::$method!='login')) {
                $this->showmessage('请登录后再操作','admin.php?controller=admin&method=login');
            }
        }
        /**
         * 核对用户信息并且显示前台页面
         * @return [type] [description]
         */
        public function login()
        {
            if ($_POST) {
                //进行登录处理
                //登录处理的业务逻辑放在admin auth里面
                //admin同表名的模型：从数据库里取用户信息
                //auth模型：进行用户信息的核对
                $this->checklogin();
            }else{
                //显示登录模板
                VIEW::display('admin/login.html');
            }
        }
        /**
         * 在业务逻辑层让数据和数据库里面的表进行比对
         * @return [type] [description]
         */
        public function checklogin()
        {
            $auth=M('auth');
            if($auth->loginsubmit()){
                $this->showmessage('登录成功！','admin.php?controller=admin&method=index');
            }else{
                $this->showmessage('登录失败！','admin.php?controller=admin&method=login');
            }
        }
        public function showmessage($mes,$url)
        {
            echo "<script>alert('$mes');window.location.href='$url'</script>";
            exit;
        }
        /**
         * 新闻首页，展现数据
         * @return [type] [description]
         */
        public function index()
        {
            $newsobj=M('news');
            $newsnum=$newsobj->count();
            VIEW::assign(array('newsnum'=>$newsnum));
            VIEW::display('admin/index.html');
        }
        public function logout()
        {
            $authobj=M('auth');
            $authobj->loginout();
            $this->showmessage('已经退出登录','admin.php?controller=admin&method=login');
        }
        /**
         * 添加、修改新闻数据的逻辑
         * @return [type] [description]
         */
        public function newsadd()
        {
            //isset($_POST)
            //首先，有post的数据，那么一定是插入或者是修改
            if ($_POST) {
                $authobj=M('news');
                $result=$authobj->newssubmit($_POST);
                $this->checkres($result);
            }else{
                //如果没有post的数据，那么就显示添加、修改的界面
                //修改旧信息，需要传递新闻的id，那么就是使用$_GET['id']
                if ($_GET['id']) {
                    $data=M('news')->getnewsinfo($_GET['id']);
                }else{
                    $data=array();
                }
                //加载进模板，名字是data
                VIEW::assign(array('data'=>$data));
                VIEW::display('admin/newsadd.html');
            }
        }
        public function newslist()
        {
            $authobj=M('news');
            $data=$authobj->findAll();
            VIEW::assign(array('data'=>$data));
            VIEW::display('admin/newslist.html');
        }
        private function checkres($result)
        {
            switch ($result) {
            case '0':
                $this->showmessage('添加失败，请重新添加','admin.php?controller=admin&method=newsadd');
                break;
            case '1':
                $this->showmessage('插入数据成功！','admin.php?controller=admin&method=newslist');
                break;
            case '2':
                $this->showmessage('更新数据成功！','admin.php?controller=admin&method=newslist');
                break;
            
            default:
                # code...
                break;
            }
        }
        public function newsdel()
        {
            if (empty($_GET['id'])) {
                $this->showmessage('没有选中信息哦','admin.php?controller=admin&method=newslist');
            }else{
                $authobj=M('news');
                $authobj->newsdel($_GET['id']);
                $this->showmessage('删除成功！','admin.php?controller=admin&method=newslist');
            }
        }
        public function resetnews()
        {
            $authobj=M('news');
            $arr=$authobj->getnewslist();
            VIEW::assign(array('data'=>$arr));
            VIEW::display('admin/shownews.html');
        }
    }