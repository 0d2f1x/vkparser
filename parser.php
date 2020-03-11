<?php
$access_token = "token"; //https://pastebin.com/DkMRZfDC - VkScript - execute.getFollowers
$user_id = 43546143;
$fileName = "ids.txt";

file_put_contents($fileName, "");
$result = file_get_contents("https://api.vk.com/method/friends.get?v=5.103&user_id=".$user_id."&count=10000&access_token=".$access_token);
$ids = json_decode($result, 1)["response"]["items"];
file_put_contents($fileName, implode("\n", $ids), FILE_APPEND);
file_put_contents($fileName, "\n", FILE_APPEND);
$count = file_get_contents("https://api.vk.com/method/users.getFollowers?v=5.103&user_id=".$user_id."&access_token=".$access_token);
$count = json_decode($count, 1)["response"]["count"];
for ($i = 0; $i < $count; $i = $i + 24999){
	$result = file_get_contents("https://api.vk.com/method/execute.getFollowers?v=5.103&user_id=".$user_id."&offset=".$i."&count=".$count."&access_token=".$access_token);
	$ids = json_decode($result, 1)["response"];
	file_put_contents($fileName, implode("\n", $ids), FILE_APPEND);
}
?>