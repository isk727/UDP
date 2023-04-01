<?php
if (is_file('../class/Raspi.class.php')) { require_once('../class/Raspi.class.php'); }
$rb = new RaspiBean();
$req = json_decode(file_get_contents("php://input"), true);
$result =[ "value" => $rb->changeIp($req['id'], $req['ip']), ];
$json = json_encode($result, JSON_UNESCAPED_UNICODE);
header("Content-Type: application/json; charset=UTF-8");
echo $json;
exit;
?>
