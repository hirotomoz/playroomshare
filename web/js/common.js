// JavaScript共通設定用
var commonJsVal = function () {
  this.sidemenu_cookie_name = 'sidemenu_flag';
  this.sidemenu_flag = "true";
}
// プロトタイプ
commonJsVal.prototype = {
  // 初期設定
  // ************************************
  onload:function () {
    if (comj.getCookie(this.sidemenu_cookie_name)) {
      this.sidemenu_flag = comj.getCookie(this.sidemenu_cookie_name);
    }
    if (this.sidemenu_flag == "false") {
      comj.hideSideMenu(true);
    }
    
  },
  // サイドメニューを非表示
  // ************************************
  hideSideMenu:function (onload_flag) {
      // 初期表示時はアニメーションしない
      if (onload_flag) {
        $('#main').css('width', '920px');
      }
      $('#sidemenu').animate({width: "toggle"},{complete:
                function(){
                  if (!onload_flag) {
                    $('#main').animate({width:'920px'});
                  }
                }
              });  
     
      if (onload_flag) {$('#sidemenu').css('display', 'none');}
      $('#sidemenu_ctr').html('表示＞＞');
      this.sidemenu_flag = "false";
      comj.setCookie(this.sidemenu_cookie_name,'false');
  },
  // サイドメニューを表示
  // ************************************
  showSideMenu:function () {
      //$('#main').css('width', '670px');
      $('#main').animate({width:'670px'},{complete:
                function(){
                  $('#sidemenu').animate({width:'toggle'});
                }
              });
              
      $('#sidemenu_ctr').html('隠す＜＜');
      comj.sidemenu_flag = "true";
      comj.setCookie(this.sidemenu_cookie_name,'true');
  },
  // クッキーの取得
  // ************************************
  getCookie:function (name) {
    if (document.cookie) {
	var cookies = document.cookie.split("; ");
        var value = "";
	for (var i = 0; i < cookies.length; i++) {
		var str = cookies[i].split("=");
		if (str[0] == name) {
			//var cookie_value = unescape(str[1]);
                        var cookie_value = str[1];
			value = cookie_value;
			break;
		}
	}    
        return value;
    } else {
      return false;
    }
  },
  // クッキーのセット
  //  path:セットパス
  //  period:有効期限日数
  // ************************************
  setCookie:function (name, value, path, period) {
    // セットするパス指定
    path = (path) ? "; path=" + path : "; path=/";
    // 有効期限の指定
    expires = "";
    if (period) {
      // 有効期限の作成
      var nowtime = new Date().getTime();
      var clear_time = new Date(nowtime + (60 * 60 * 24 * 1000 * period));
      var expires = clear_time.toGMTString();  
      expires = "; expires=" + expires;
    }
    document.cookie = name + "=" + escape(value) + path + expires;
  }
}

// 日付取得
function getDateData(){
  myD = new Date() ;
  myYear	= myD.getFullYear();	// 年
  myMonth	= myD.getMonth()+1;	// 月
  myDate	= myD.getDate();	// 日
  myDay         = myD.getDay();	// 曜日
  myHours	= myD.getHours();	// 時
  myMinutes	= myD.getMinutes();	// 分
  mySeconds	= myD.getSeconds();	// 秒
  return myYear+'/'+myMonth+'/'+myDate+'('+myDay+') '+
          myHours+':'+myMinutes+':'+mySeconds;
}

// インスタンス生成
var comj = new commonJsVal();

//jQuery
$(function (){
  // 初期起動
  comj.onload();
  // サイドメニューコントローラ
  $('#sidemenu_ctr').click(function(){
    //$('#sidemenu').toggle(500);
    //$('#sidemenu').animate({width: "toggle"});  
    if(comj.sidemenu_flag == "true"){
      comj.hideSideMenu();
    } else {
      comj.showSideMenu();
    }
  });
});