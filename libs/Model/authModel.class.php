<?php
    /**
    * 在于用户信息和数据库的比对
    */
    class authModel
    {
    	//判断用户是否登录，关键在于这个值
    	//因此不能把这个值设置为public，防止它被赋予任意值
    	private $auth='';//当前管理员信息

    	public function __construct()
    	{
    		if (isset($_SESSION['auth'])&&(!empty($_SESSION['auth'])) ) {
    			$this->auth=$_SESSION['auth'];
    		}
    	}
    	/**
    	 * 把数据通过post方式传递过来，然后进行对照检测
    	 * @return [type] [description]
    	 */
    	public function loginsubmit()
    	{
    		if (empty($_POST['username'])&&empty($_POST['password'])) {
    			return false;
    		}
    		$username=addslashes($_POST['username']);
    		$password=addslashes($_POST['password']);
    		if ($this->auth==$this->checkuser($username,$password)) {
    			//这里存储用户的数据
    			$_SESSION['auth']=$this->auth;
    			return true;
    		}else{
    			return false;
    		}
    	}
    	/**
    	 * 检测数据库中是否具有用户信息
    	 * @param  [type] $username [description]
    	 * @param  [type] $password [description]
    	 * @return [type]           [description]返回用户信息的数组，或者false
    	 */
    	public function checkuser($username,$password)
    	{
    		$adminobj=M('admin');
    		$auth=$adminobj->findOne_by_username($username);
    		if ((!empty($auth))&&$auth['password']==$password) {
    			return $auth;
    		}else{
    			return false;
    		}
    	}
    	/**
    	 * 返回用户信息
    	 * @return [type] [description]
    	 */
    	public function getauth()
    	{
    		return $this->auth;
    	}
        public function loginout()
        {
            unset($_SESSION['auth']);
            $this->auth='';
        }
    }