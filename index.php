<?php
if (is_file('./class/Raspi.class.php')) { require_once('./class/Raspi.class.php'); }
if (is_file('./class/Setting.class.php')) { require_once('./class/Setting.class.php'); }
$rb = new RaspiBean();
$rb->where = "id>0";
$raspi = $rb->getEntries();
$sb = new SettingBean();
$values = $sb->getValues();
$buttons = $sb->getButtons();
// /////////////////////////////////////////
$btn = array('s', 't', 'u');
// /////////////////////////////////////////
$accordion_header = array('headingOne', 'headingTwo', 'headingThree');
$data_bs_target = array('#collapseOne', '#collapseTwo', '#collapseThree');
$aria_controls = array('collapseOne', 'collapseTwo', 'collapseThree');
$div_id = array('collapseOne', 'collapseTwo', 'collapseThree');
$aria_labelledby = array('headingOne', 'headingTwo', 'headingThree');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="HandheldFriendly" content="True" />
  <title>UDP test</title>
  <link rel="icon" href="img/favicon.png" type="image/png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-migrate-3.4.0.min.js" integrity="sha256-mBCu5+bVfYzOqpYyK4jm30ZxAZRomuErKEFJFIyrwvM=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.6.1/js/iziModal.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.6.1/css/iziModal.css">
  <link rel="stylesheet" href="./css/style.css" media="screen">
</head>
<body>
<div class="container">
  <div class="row row-cols-2 row-cols-lg-2 g-2 g-lg-2">
    <div class="col">
      <div class="p-3 bg-white"><h3><a href="index.php" style="text-decoration:none;"><img src="img/favicon.png" width="32px"> テストページ</h3></a></div>
    </div>
    <div class="col">
      <div class="p-3 bg-white" style="text-align:right;"><a href='javascript:window.open("setting.php", "mozillaWindow",  "left=20,top=20,width=450,height=700");' style="text-decoration:none;">設定 <img src="img/setting.png" width="24px;"></a></div>
    </div>
  </div>
</div>
<div class="accordion" id="accordionExample">
<!-- --------------------------------------------------------- -->
<?php
$ct = 0;
foreach($raspi as $rp) {
?>
  <div class="accordion-item">
    <h2 class="accordion-header" id="<?= $accordion_header[$ct] ;?>">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="<?= $data_bs_target[$ct] ;?>" aria-expanded="false" aria-controls="<?= $aria_controls[$ct] ;?>" onclick="changeSlot('<?= $rp->ip; ?>');">
        <img src="img/slot/<?= $rp->image; ?>" width="50px;">　
        <span id="rpid<?= $rp->id; ?>" style="font-size: 2rem;"><?= $rp->ip; ?></span>
      </button>
    </h2>
    <div id="<?= $div_id[$ct] ;?>" class="accordion-collapse collapse" aria-labelledby="<?= $aria_labelledby[$ct] ;?>" data-bs-parent="#accordionExample">
      <div class="accordion-body">

<table>
  <tr>
    <td><button data-iziModal-open=".iziModal" class="btn btn-primary btn-lg buttonlg" onclick="setCommand('<?= $values['power']; ?>');"><?= $buttons['power']; ?></button></td>
    <td><button data-iziModal-open=".iziModal" class="btn btn-primary btn-lg buttonlg" onclick="setCommand('<?= $values['poweroff']; ?>');"><?= $buttons['poweroff']; ?></button></td>
    <td rowspan=3 style="vertical-align: top; text-align:center;">
     <div>　</div><div>
     <button id="<?= $btn[$ct]; ?>1" class="btn btn-outline-primary btn-sm" onclick="set(<?= $ct; ?>, this);">1</button>
     <button id="<?= $btn[$ct]; ?>2" class="btn btn-outline-primary btn-sm" onclick="set(<?= $ct; ?>, this);">2</button>
     <button id="<?= $btn[$ct]; ?>3" class="btn btn-outline-primary btn-sm" onclick="set(<?= $ct; ?>, this);">3</button>
     <button id="<?= $btn[$ct]; ?>4" class="btn btn-outline-primary btn-sm" onclick="set(<?= $ct; ?>, this);">4</button>
     <button id="<?= $btn[$ct]; ?>5" class="btn btn-outline-primary btn-sm" onclick="set(<?= $ct; ?>, this);">5</button>
     <button id="<?= $btn[$ct]; ?>6" class="btn btn-outline-primary btn-sm" onclick="set(<?= $ct; ?>, this);">6</button>
     </div><div id="sv<?= $ct; ?>" style="color: white;">　</div>
     <div>
      <button disabled id="setting-<?= $btn[$ct]; ?>" data-iziModal-open=".iziModal" class="btn btn-primary btn-lg buttonlg" style="width:6em;" onclick="setCommand2(<?= $ct; ?>);"><?= $buttons['setting']; ?></button>
      <button id="settingconf-<?= $btn[$ct]; ?>" class="btn btn-secondary btn-lg buttonlg" style="width:6em;">設定確認</button>
    </div>
    </td>
    <td rowspan=3>
<table class="table-css"><!-- ----------------------------- -->
  <tr>
    <td colspan="2">
      <button id="request" class="btn btn-secondary btn-lg buttonlg">筐体情報要求</button>
    </td>
    <td colspan="2">
      <button id="clr" class="btn btn-secondary btn-lg buttonlg">筐体情報CLR</button>
    </td>
  </tr>
  <tr>
    <td class="td-css1">残PT</td>
    <td class="td-css2">993</td>
    <td colspan="2"><label for="sample_checkbox"><input type="checkbox" id="sample_checkbox" /> 10秒毎に自動更新</label></td>
  </tr>
  <tr>
    <td class="td-css1">PT累計</td><td class="td-css2">2000</td>
    <td class="td-css1">精算累計</td><td class="td-css2">0</td>
  </tr>
  <tr>
    <td class="td-css1">IN枚数</td><td class="td-css2">21</td>
    <td class="td-css1">OUT枚数</td><td class="td-css2">　　14</td>
  </tr>
</table><!-- ----------------------------- -->
    </td>
  </tr>
  <tr>
    <td><button data-iziModal-open=".iziModal" class="btn btn-primary btn-lg buttonlg" onclick="setCommand('<?= $values['point']; ?>');"><?= $buttons['point']; ?></button></td>
    <td><button data-iziModal-open=".iziModal" class="btn btn-primary btn-lg buttonlg" onclick="setCommand('<?= $values['check']; ?>');"><?= $buttons['check']; ?></button></td>
  </tr>
  <tr>
    <td><button data-iziModal-open=".iziModal" class="btn btn-primary btn-lg buttonlg" onclick="setCommand('<?= $values['coin']; ?>');"><?= $buttons['coin']; ?></button></td>
    <td><button data-iziModal-open=".iziModal" class="btn btn-primary btn-lg buttonlg" onclick="setCommand('<?= $values['game']; ?>');"><?= $buttons['game']; ?></button></td>
  </tr>
</table>

      </div>
    </div>
  </div>
<?php $ct++; } ?>
<!-- -------------------------------------------------------------- -->
<div class="iziModal" data-izimodal-title="送信先IP・ポートと送信内容">
  <div>　</div>
  <div style="margin-left:3rem;">
    IP: <input type="text" id="ip" class="inputtext" value="" style="width:8rem;" disabled>
    PORT: <input type="text" id="port" class="inputtext" value="<?= $values['port'] ?>" style="width:4rem;" disabled>
  </div>
  <div>　</div>
  <div style="margin-left:3rem;">
    COMMAND: <input type="text" id="Result" class="inputtext" style="width:10rem;" value="" disabled>
    <button id="s" class="btn btn-primary btn-sm" onclick="ajaxSendUDP();"> 送信 </button>
  </div>
  <div>　</div>
</div>
<!-- -------------------------------------------------------------- -->
<script src="./js/script.js"></script>
<script>
var arr = ["<?= $values['setting1']; ?>", "<?= $values['setting2']; ?>", "<?= $values['setting3']; ?>", "<?= $values['setting4']; ?>", "<?= $values['setting5']; ?>", "<?= $values['setting6']; ?>"];
$(function(){
<?php foreach($raspi as $rp) { ?>
  $('#rpid<?= $rp->id; ?>').click(function() {
    if (!$(this).hasClass('on')) {
      $(this).addClass('on');
      let txt = $(this).text();
      $(this).html('<input type="text" style="width:8em;" value="'+txt+'" />');
      $('#rpid<?= $rp->id; ?> > input').focus().blur(function() {
        let inputVal = $(this).val();
        $(this).parent().removeClass('on').text(inputVal);
        ajaxChangeIp(<?= $rp->id; ?>, inputVal);
        sleep(500).then( ()=>{
          location.reload();
        });
      });
      $('#rpid<?= $rp->id; ?> > input').keypress(function(e) {
        let inputVal = $(this).val();
        if (e.keyCode == 13) {
          swal("※IPアドレスが" + inputVal + "に変更されました");
          sleep(500).then( ()=>{});
        }
      });
    }
  });
<?php } ?>
});
</script>
</body>
</html>