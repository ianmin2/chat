
<?php
//echo phpinfo();

$ch = curl_init("http://www.ianmin2.tk/");
$fp = fopen("test.txt", "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);

?>
