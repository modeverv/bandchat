function App(){}
App.prototype.load = function(_cursor){
    $.ajax({
        context:this,
        async:true,
        dataType: "json",
        url: "load.php",
        data: {cursor:_cursor},
        success:function(data){
            if(data.length > 0){
                this._plot(data);
            }
        }
    });
};
App.prototype.refresh = function(){
    this.load(this._cursor);
};
App.prototype.say = function(){
    var content = $("#input").val();
    if("" == content){
        return;
    }
    var name = getName();
    var data = {name:name,content:content};
    $.ajax({
        context:this,
        async:true,
        dataType: "json",
        url : "say.php",
        data : data,
        success : function(json){
            $("#input").val("");
        }
    });
    this.refresh();
};
/** private */
App.prototype._cursor = 0;
App.prototype._data = "";
App.prototype._bottom = function(){
    setTimeout(function() {
        window.scroll(0,$(document).height());
    },0);
};
App.prototype._plot = function(data){
    var name = getName();
    for(var i=0,l=data.length;i<l;i++){
        if(name == data[i].name) {
            this._plotInner(data[i],"me");
        } else {
            this._plotInner(data[i],"other");
        }
        this._cursor = data[i].id;
    }
    $("#chat").append(this._data);
    this._data = "";
    this._bottom();
};
App.prototype._plotInner = function(chat,kind){
    if(kind == "me"){
        var template = $("#me").text();
    }else{
        var template = $("#other").text();
    }
    var html = template.replace(/\{name\}/,chat.name).replace(/\{content\}/,chat.content).replace(/\{date\}/,chat.created_at);
    this._data += html;
};

/** main */
$(function(){
    var chat = new App();
    // initial load
    chat.load("load");
    // event
    $("#say").click(function(){ chat.say(); });
    // polling
    setInterval(function(){chat.refresh();},5000);
});
