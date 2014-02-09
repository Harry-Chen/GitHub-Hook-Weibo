<?
header("Content-type: text/html; charset=utf-8");
$config=file_get_contents('repo_config.json');
$data=json_decode($config,true);
if($data===FALSE){
	//TODO 处理
}
echo("<pre>");
var_dump($data);
echo("</pre>");
