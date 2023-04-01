<?php
$req = json_decode(file_get_contents("php://input"), true);
$socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
socket_sendto($socket, $req['dgram'], strlen($req['dgram']), 0, $req['ip'], $req['port']);
socket_close($socket);
$result =[ "value" => $req['dgram'], ];
$json = json_encode($result, JSON_UNESCAPED_UNICODE);
header("Content-Type: application/json; charset=UTF-8");
echo $json;
exit;
?>
