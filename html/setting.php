<?php
if (is_file('./class/Setting.class.php')) { require_once('./class/Setting.class.php'); }
$sb = new SettingBean();
$values = $sb->getValues();
$buttons = $sb->getButtons();

$re = 0;
if ($_POST['re']) {
  $re = 1;
  $sb->saveKeyValue("port", $_POST['port']);
  $sb->saveKeyValue("power", $_POST['power']);
  $sb->saveKeyValue("poweroff", $_POST['poweroff']);
  $sb->saveKeyValue("point", $_POST['point']);
  $sb->saveKeyValue("check", $_POST['check']);
  $sb->saveKeyValue("setting1", $_POST['setting1']);
  $sb->saveKeyValue("setting2", $_POST['setting2']);
  $sb->saveKeyValue("setting3", $_POST['setting3']);
  $sb->saveKeyValue("setting4", $_POST['setting4']);
  $sb->saveKeyValue("setting5", $_POST['setting5']);
  $sb->saveKeyValue("setting6", $_POST['setting6']);
  $sb->saveKeyValue("coin", $_POST['coin']);
  $sb->saveKeyValue("game", $_POST['game']);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="HandheldFriendly" content="True" />
<title>設定</title>
<link rel="icon" href="img/favicon.png" type="image/png">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-3.4.0.min.js" integrity="sha256-mBCu5+bVfYzOqpYyK4jm30ZxAZRomuErKEFJFIyrwvM=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<script>
let x = <?= $re; ?>;
if (x == 1) {
  window.opener.location.reload();
  window.close();
}
</script>
<style>
  td, th { padding: 5px 5px; }
  .port { width:5rem; }
  .command { width:15rem; }
</style>
<body style="background-color:#ddd;">
<div style="margin-left:2rem;margin-top:1rem;">
<form name="frm" method="post" action="setting.php">
<input type="hidden" name="re" value="1">
<span style="font-size: 28px;"><img src="img/setting.png" style="vertical-align: middle;"  width="32px;"> 設 定</span>
<div>　</div>
<table>
  <tr>
    <td><?= $buttons['port']; ?></td>
    <td><input type="text" name="port" class="port" value="<?= $values['port']; ?>"></td>
  </tr>
  <tr>
    <td>　</td>
    <td>　</td>
  </tr>
  <tr>
    <td><?= $buttons['power']; ?></td>
    <td><input type="text" name="power" class="command" value="<?= $values['power']; ?>"></td>
  </tr>
  <tr>
    <td><?= $buttons['poweroff']; ?></td>
    <td><input type="text" name="poweroff" class="command" value="<?= $values['poweroff']; ?>"></td>
  </tr>
  <tr>
    <td><?= $buttons['point']; ?></td>
    <td><input type="text" name="point" class="command" value="<?= $values['point']; ?>"></td>
  </tr>
  <tr>
    <td><?= $buttons['check']; ?><?= $btn_check; ?></td>
    <td><input type="text" name="check" class="command" value="<?= $values['check']; ?>"></td>
  </tr>
<?php for ($ct = 0; $ct < 6; $ct++) { ?>
  <tr>
    <td><?= $buttons["setting".($ct+1)]; ?></td>
    <td><input type="text" name="setting<?= $ct + 1; ?>" class="command" value="<?= $values["setting".($ct+1)]; ?>"></td>
  </tr>
<?php } ?>
  <tr>
    <td><?= $buttons['coin']; ?></td>
    <td><input type="text" name="coin" class="command" value="<?= $values['coin']; ?>"></td>
  </tr>
  <tr>
    <td><?= $buttons['game']; ?></td>
    <td><input type="text" name="game" class="command" value="<?= $values['game']; ?>"></td>
  </tr>
</table>
<br>
<input class="btn btn-primary" type="submit" value=" 保存して閉じる ">
</form>
</div>
</body>
</html>