$(function(){ $(".iziModal").iziModal(); });
/* ================================================== */
const sleep = waitTime => new Promise( resolve => setTimeout(resolve, waitTime) );
/* ================================================== */
const ajaxChangeIp = (id, ip) => {
  let data = {
    "id" : id,
    "ip" : ip
  };
  let json = JSON.stringify(data);
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "./ajax/ajaxChangeIp.php");
  xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded;charset=UTF-8");
  xhr.send(json);
  xhr.onreadystatechange = function () {
    try {
      if (xhr.readyState == 4 && xhr.status == 200) {
        let result = JSON.parse(xhr.response);
        return result.value;
      } else {
      }
    } catch (e) {
    }
  };
};
/* ================================================== */
const set = (ln, bt) => {
    let sx = (bt.id).charAt( 0 );
    let ix = (bt.id).charAt( 1 );
    for (let i = 0; i < 6; i++) {
      let elm = $("#" + sx + (i + 1));
      if (ix == (i + 1)) {
        $('#sv' + ln).html(ix);
        $(elm).removeClass("btn-outline-primary").addClass("btn-primary");
      } else {
        $(elm).removeClass("btn-primary").addClass("btn-outline-primary");
      }
    }
    $("#" + "setting-" + sx).prop("disabled", false);
};
/* ================================================== */
const changeSlot = (ip) => { $('#ip').val(ip); };
/* ================================================== */
const setCommand = (com) => { $('#Result').val(com); };
/* ================================================== */
const setCommand2 = (ln) => {
  let j = $("#sv" + ln).html();
  $('#Result').val(arr[j - 1]);
};
/* ================================================== */
const ajaxSendUDP = () => {
  let ip = $('#ip').val();
  let port = $('#port').val();
  let dgram = $('#Result').val();
  $('#Result').val("送信中です…");
  let data = {
    "ip" : ip,
    "port" : port,
    "dgram": dgram
  };
  let json = JSON.stringify(data);
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "./ajax/ajaxSendUDP.php");
  xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded;charset=UTF-8");
  xhr.send(json);
  xhr.onreadystatechange = function () {
    try {
      if (xhr.readyState == 4 && xhr.status == 200) {
        let result = JSON.parse(xhr.response);
        $('#Result').val(result.value == 0 ? "" : result.value);
      } else {
      }
    } catch (e) {
    }
  };
};

/* ==================================================
※以下 現行では未使用
 ================================================== */
const ajaxCheckUDP = () => {
  let ip = document.getElementById("ip").value;
  let port = document.getElementById("port").value;
  let code = document.getElementById("Result").value;
  document.getElementById("Result").value = "送信中です…";
  let data = {
    "ip" : ip,
    "port" : port,
    "code": code
  }
  let json = JSON.stringify(data);
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "./ajax/ajaxCheckUDP.php");
  xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded;charset=UTF-8");
  xhr.send(json);
  xhr.onreadystatechange = function () {
    try {
      if (xhr.readyState == 4 && xhr.status == 200) {
        let result = JSON.parse(xhr.response);
        document.getElementById("Result").value = result.value == 0 ? "選択してください" : result.value;
      } else {
      }
    } catch (e) {
    }
  };
};
/* ================================================== */
const ajaxSendUDPp = () => {
  let ip = document.getElementById("ip").value;
  let port = document.getElementById("port").value;
  let code = document.getElementById("Result").value;
  document.getElementById("Result").value = "送信中です…";
  var data2 = {
    "ip" : ip,
    "port" : port,
    "code": code
  }
  var json = JSON.stringify(data2);
       $.ajax({
           url: './ajax/udp-ajax.py',
           type: 'post',
           data: data2
       }).done(function(data){
           document.getElementById("Result").value = data;
       }).fail(function(){
document.getElementById("Result").value ='failed';
       });

};

const ajaxSendUDP2 = () => {
  let ip = document.getElementById("ipx").value;
  let port = "90"; //document.getElementById("port").value;
  let code = "80"; //document.getElementById("Result").value;
//  document.getElementById("ipx").value = "送信中です…";
  var data = {
    "ip" : ip,
    "port" : port,
    "code": code
  }
  var json = JSON.stringify(data);
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./ajax/udp-ajax2.php");
  xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded;charset=UTF-8");
  xhr.send(json);
  xhr.onreadystatechange = function () {
    try {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          var result = JSON.parse(xhr.response);
          document.getElementById("ipx").value = result.value == 0 ? "選択してください" : result.value;
        } else {
        }
      } else {
      }
    } catch (e) {
    }
  };
};

const ajaxSendUDPJ = () => {
  let ip = document.getElementById("ip").value;
  let port = document.getElementById("port").value;
  let code = document.getElementById("Result").value;
  document.getElementById("Result").value = "送信中です…";
  var data = {
    "ip" : ip,
    "port" : port,
    "code": code
  }
  var json = JSON.stringify(data);
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../rp/servlet/ajaxSendUdp");
  xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded;charset=UTF-8");
  xhr.send(json);
  xhr.onreadystatechange = function () {
    try {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          var result = JSON.parse(xhr.response);
          document.getElementById("Result").value = result.value == 0 ? "選択してください" : result.value;
        } else {
        }
      } else {
      }
    } catch (e) {
    }
  };
};