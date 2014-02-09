<?php
include_once('sdk.php');
ini_set("display_errors", 1);
ini_set("error_reporting", E_ALL);
define("WB_AKEY", '2080193189');
define("WB_SKEY", 'f059576e3fbbbd10bd5d960c3cf02212');
define("ACCESS_TOKEN", '2.00KPQIuDDRRmQC43da63944d0k7WJc');
define("NOTIFY",' @HarryChen-SIGKILL- @一抔学渣');
$weibo = new SaeTClientV2(WB_AKEY, WB_SKEY, ACCESS_TOKEN);
$payload = $_POST['payload'];
if ($payload == '') {
    $payload = $_GET['payload'];
}
$data = json_decode($payload);
if (is_object($data) && is_array($data->commits)) {
    $refs = substr($data->ref, 11);
    $repo = $data->repository->name;
    foreach ($data->commits as $commit) {
        $data = array(
            'author' => $commit->author->name,
            'message' => explode("\n", $commit->message) ,
            'url' => $commit->url,
            'id' => substr($commit->id, 0, 6)
        );
        $content = $data['author'] . ' - [' . $repo . ' ' . $refs . ' ' . $data['id'] . ']: ' . $data['message'][0] . ' ' . 
$data['url'] . NOTIFY;
        echo $content . '<br />';
        $ret = $weibo->update($content);
        if (isset($ret['error_code']) && $ret['error_code'] > 0) {
            echo "<p>发送失败，错误：{$ret['error_code']}:{$ret['error']}</p>";
        }
    }
} else {
    die('no_data');
}

