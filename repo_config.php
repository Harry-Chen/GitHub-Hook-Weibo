<?
header("Content-type: text/html; charset=utf-8");
$con = mysql_connect('localhost','paperairplane','PaperA1rplane');
	if (!con){
		die('Error connecting database.');
	}

mysql_select_db('paperairplane',$con);

if($_POST['action']==='new'){
	//添加新repo
	//查重
	$result = mysql_query("SELECT 1 FROM hook_repo WHERE repo_name = ' " . $_POST['repo_name'] . "' AND owner_uid = ' "  /* . CurrentUserUID */ . "'");

}