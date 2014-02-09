<body>
<?
$auth_info=file_get_contents('weibo_config.json');
if($auth_info===FALSE){
	//无此文件，会在以后版本添加配置功能，目前只能读取
}
$auth_info=json_decode($auth_info,true);
//var_dump($auth_info);
echo($auth_info['AppKey']);
echo('<br />');
echo($auth_info['AppSecret']);
echo('<br />');
echo($auth_info['AccessToken']);
