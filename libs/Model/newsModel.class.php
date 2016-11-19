<?php
    /**
    * 
    */
    class newsModel
    {
    	public $_table='news';
    	public function count()
    	{
    		$sql="SELECT COUNT(*) FROM {$this->_table}";
    		return DB::findResult($sql,0,0);
    	}
        public function insert($array)
        {
            return DB::insert($this->_table,$array);
        }
        public function findAll()
        {
            $sql="SELECT * FROM {$this->_table} order by id desc";
            return DB::findAll($sql);
        }
        /**
         * 获取新闻的id
         * @param  [type] $id [description]
         * @return [type]     [description]
         */
        public function getnewsinfo($id)
        {
            if (empty($id)) {
                return array();
            }else{
                $id=intval($id);//防止sql注入，转化为数字
                $sql="SELECT * FROM {$this->_table} WHERE id={$id}";
                return DB::findOne($sql);
            }
        }
        /**
         * 根据情况提交数据
         * @param  [type] $data [description]
         * @return [type]       [description]
         */
        public function newssubmit($data)
        {
            extract($data);//把它从数组变为变量
            if ((empty($title))||(empty($description))) {
                echo "没有文章";
                return 0;
            }
            $title=addslashes($title);
            $description=addslashes($description);
            $auth=addslashes($auth);
            $from=addslashes($from);
            $arr = array('title' =>$title ,
                'description'=>$description,
                'auth'=>$auth,
                'from'=>$from
             );
            if ($_POST['id']=='') {
                DB::insert($this->_table,$arr);
                return 1;
            }else{
                echo "进入修改";
                DB::update($this->_table,$arr,$id);
                return 2;
            }
        }
        /**
         * 根据情况删除数据
         * @param  [type] $id [description]
         * @return [type]     [description]
         */
        public function newsdel($id)
        {
            return DB::delete($this->_table,$id);
        }
        //处理数据
        /**
         * 从数据库中取出新闻，并只显示其中的一部分
         * @return [type] [description]
         */
        public function getnewslist()
        {
            $sql="SELECT * FROM {$this->_table} order by id desc";
            $arr=DB::findAll($sql);
            foreach ($arr as $key => $value) {
                //mb_substr中文专用
                $value['description']=mb_substr($value['description'], 0,3);
                $value['time']=date('Y-m-d H:i:s',$value['time']);
                $newarr[]=array(
                    'description'=>$value['description'],
                    'time'=>$value['time']
                    );
            }
            return $newarr;
        }
    }