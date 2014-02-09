<?php
function getWeiboAuthInfo(){
	$auth_info=file_get_contents('weibo_config.json');
	if($auth_info===FALSE){
        	//TODO 跳转到weibo_config.php进行配置
	}
	$decoded=json_decode($auth_info,true);
	return $decoded;
}

function getNotifyName($repoName){
	$config=file_get_contents('repo_config.json');
	$data=json_decode($config);
	//var_dump($data);
	if($data===FALSE){
        	//TODO 跳转到config
	}
	if(is_array($data)){
		foreach($data as $repo){
			//var_dump($repo);
			$name=$repo->repo_name;
			if($name===$repoName){
				return implode(' ',$repo->notify_user_name);
			}
			else{
				//TODO 又是错误处理
			}
		}
	}
}

include_once('sdk.php');
ini_set("display_errors", 1);
ini_set("error_reporting", E_ALL);

$auth_info=getWeiboAuthInfo();
//var_dump($auth_info);
$weibo = new SaeTClientV2($auth_info['AppKey'], $auth_info['AppSecret'] ,$auth_info['AccessToken']);

$payload = $_POST['payload'];
if ($payload == '') {
    $payload = $_GET['payload'];
}
$data = json_decode($payload);
if (is_object($data) && is_array($data->commits)) {
    $refs = substr($data->ref, 11);
    $repo = $data->repository->name;
    $notify = getNotifyName($repo);
    foreach ($data->commits as $commit) {
        $data = array(
            'author' => $commit->author->name,
            'message' => explode("\n", $commit->message) ,
            'url' => $commit->url,
            'id' => substr($commit->id, 0, 6)
        );
        $content = $data['author'] . ' - [' . $repo . ' ' . $refs . ' ' . $data['id'] . ']: ' . $data['message'][0] . ' ' . 
$data['url'] . ' ' .  $notify;
        echo $content . '<br />';
        $ret = $weibo->update($content);
        if (isset($ret['error_code']) && $ret['error_code'] > 0) {
            echo "<p>发送失败，错误：{$ret['error_code']}:{$ret['error']}</p>";
        }
    }
} else {
    die('没有数据');
}
