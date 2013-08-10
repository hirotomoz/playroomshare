// jQuery
$(function(){
  $(window).scroll(function(){
    var dy = $(this).scrollTop();
    console.log(dy);
    $('#bg').css('background-position',"center " + dy/1.2 + "px");
  });
  // ページの終わりまでスクロール
  $.scrollTo('#eof',3000);
});