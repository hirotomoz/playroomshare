var feed_cnt = 10;
// jQuery
$(function(){
    setInterval(function(){
      var date = getDateData();
      var addData = $('<li>'+date+'</li>')
                      .css('display','none')
                      .addClass('feedclass');
      $("#feed1").prepend(addData)
                .find('li')
                  .slideDown("slow")
                .end();
      if ($("#feed1 .feedclass").size() > feed_cnt) {
        $("#feed1 .feedclass:eq("+feed_cnt+")").hide("slow");
        if ($("#feed1 .feedclass:eq("+(feed_cnt+1)+")")) {
          $("#feed1 .feedclass:eq("+(feed_cnt+1)+")").remove();
        }
      }
	    },1000);

    setInterval(function(){
      var date = getDateData();
      var addData = $('<li>'+date+'</li>')
                      .css('display','none')
                      .addClass('feedclass');
      $("#feed2").prepend(addData)
                .find('li')
                  .slideDown("slow")
                .end();
      if ($("#feed2 .feedclass").size() > feed_cnt) {
        $("#feed2 .feedclass:eq("+feed_cnt+")").hide("slow");
        if ($("#feed2 .feedclass:eq("+(feed_cnt+1)+")")) {
          $("#feed2 .feedclass:eq("+(feed_cnt+1)+")").remove();
        }
      }
	    },2000);

    setInterval(function(){
      var date = getDateData();
      var addData = $('<li>'+date+'</li>')
                      .css('display','none')
                      .addClass('feedclass');
      $("#feed3").prepend(addData)
                .find('li')
                  .slideDown("slow")
                .end();
      if ($("#feed3 .feedclass").size() > feed_cnt) {
        $("#feed3 .feedclass:eq("+feed_cnt+")").hide("slow");
        if ($("#feed3 .feedclass:eq("+(feed_cnt+1)+")")) {
          $("#feed3 .feedclass:eq("+(feed_cnt+1)+")").remove();
        }
      }
	    },500);

});
