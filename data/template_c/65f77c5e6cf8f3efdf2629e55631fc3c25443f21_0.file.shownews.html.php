<?php
/* Smarty version 3.1.30, created on 2016-11-19 17:02:55
  from "D:\amp\apache\htdocs\mvc01\tpl\admin\shownews.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5830153f180615_39497785',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '65f77c5e6cf8f3efdf2629e55631fc3c25443f21' => 
    array (
      0 => 'D:\\amp\\apache\\htdocs\\mvc01\\tpl\\admin\\shownews.html',
      1 => 1479546171,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5830153f180615_39497785 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>新闻显示页面</title>
    <style type="text/css">
    table{
        border: 1px solid black;
        margin:0 auto;
        width: 1000px;
    }
    table tr,table td{
        border: 1px solid grey;
    }
    </style>
</head>
<body>
    <table>
        <caption>新闻列表</caption>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['value']->value['description'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['value']->value['time'];?>
</td>
        </tr>
        <?php
}
} else {
?>

            <tr>
                <td>暂无新闻</td>
            </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </table>

</body>
</html><?php }
}
