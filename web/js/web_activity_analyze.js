// WEBアクティビティ解析基底クラス
var WebActivityAnalyze = function () {
  this.cookie_enable = window.navigator.cookieEnabled;
  this.cookie_name = 'CWAA';
  this.cookie;
  this.page;
};

// prototype
WebActivityAnalyze.prototype = {
  // ロード時 //////////////////////////////////////////////////
  onload : function () { 
    window.onblur = this.blurFunc;
    window.onfocus = this.focusFunc;

    if (this.cookie_enable) {
      this.cookie = this.getCookie(this.cookie_name);
      if (this.cookie) {
        // アクセス
        console.log(this.cookie); 
      } else {
        // 初アクセス
        console.log('初回訪問');
      }
    } else {
      console.log('クッキー無効端末');
    }
  },
  // 非活性時 //////////////////////////////////////////////////
  blurFunc : function () { console.log('thisウィンドウ非活性'); },
  // 活性時 //////////////////////////////////////////////////
  focusFunc : function () { console.log('thisウィンドウ活性'); },
  // getCookie //////////////////////////////////////////////////
  getCookie : function (cookie_name) {
    var cookieArray = document.cookie.split(";");
    for (i=0;i<cookieArray.length;i++) {
      x = cookieArray[i].substr(0,cookieArray[i].indexOf("="));
      y = cookieArray[i].substr(cookieArray[i].indexOf("=")+1);
      x = x.replace(/^\s+|\s+$/g,"");
      if(x === cookie_name) { return unescape(y); }
    }
    return false;
  }
};

// 解析開始
var WAA = new WebActivityAnalyze;
WAA.onload();

// jQuery
$(function(){
});