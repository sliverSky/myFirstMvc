<?php
    header("Content-type:text/html;charset=utf-8");
    session_start();
    require('config.php');
    include('./framework/PC.php');
    //对引擎参数进行配置
    PC::run($config);