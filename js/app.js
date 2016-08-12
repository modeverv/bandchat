var App = {
  load : function(cursor){
      $.ajax({
                 async:false,
                 dataType: "json",
                 url: "load.php",
                 data: {cursor:cursor},
                 success:function(data){
                     App._plot(data);
                 }
             });
  },
  refresh : function(){
    App.load(App._cursor);
  },
  say : function(){
     var content = $("#input").val();
     if("" == content){
         return;
     }
     var name = getName();
     var data = {name:name,content:content};
     $.ajax({
                async:false,
                dataType: "json",
                url : "say.php",
                data : data,
                success : function(json){
                   $("#input").val("");
                }
            });
     App.refresh();
  },
  _bottom : function(){
     setTimeout(function() {
         window.scroll(0,$(document).height());
     },0);
  },
  _cursor : 0,
  _data : "",
  _plot : function(data){
      var name = getName();
      for(var i=0,l=data.length;i<l;i++){
          if(name == data[i].name) {
              App._plot_(data[i],"me");
          } else {
              App._plot_(data[i],"other");
          }
          App._cursor = data[i].id;
      }
      $("#chat").append(App._data);
      App._data = "";
      if(data.length > 0){
        App._bottom();
      }
  },
  _plot_ : function(chat,kind){
      if(kind == "me"){
        var template = $("#me").text();
      }else{
        var template = $("#other").text();
      }
      var plot = template.replace(/\{name\}/,chat.name).replace(/\{content\}/,chat.content);
      App._data += plot;
  }
};


$(function(){
  App.load("load");
  // event
  $("#say").click(function(){ App.say(); });
  // polling
  setInterval(App.refresh,1000);
});