<?
header("Content-type: text/html; charset=utf-8");
$config=file_get_contents('config/repo_config.json');
if($config===FALSE){
	$trunc='[';
}
else {
	$trunc=substr($config,0,strlen($config)-1) . ',';
}
//echo($trunc);
if($_POST['action']==='new'){
	//TODO 判重
	$repo_name=$_POST['repo_name'];
	$notify_users=explode(',',$_POST['notify_users']);
	$new_repo=array( 'repo_name' => $repo_name,
			 'notify_user_name' => $notify_users );
	//var_dump($new_repo);
	$encoded=json_encode($new_repo);
	$result=$trunc . $encoded . ']';
	echo($result);
	file_put_contents('repo_config.json',$result);
}
