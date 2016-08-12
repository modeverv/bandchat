<?php
$name = "名無し";
if(isset($_COOKIE["name"])){
    $name = $_COOKIE["name"];
}
if(isset($_REQUEST["name"])){
    $name = $_REQUEST["name"];
}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <title>bandchat</title>
    <link rel="stylesheet" href="css/app.css" type="text/css" media="screen" />
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>    
    <script>
      var NAME = '名無し';
      function getName(){
          if($("#name").val() != ""){
             NAME = $("#name").val();
          }
          return NAME;
      }
    </script>
    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/template" id="me">
      <div class="me">
        <h5>{name}</h5>
        <div>{content}</div>
      </div>
    </script>
    <script type="text/template" id="other">
      <div class="other">
        <h5>{name}</h5>
        <div>{content}</div>
      </div>
    </script>
  </head>
  <body>
    <div id="main">
      <h1>おれらのLINE<br/>(<span style="color:red">not secure</span>)</h1>
      <div id="chat">
      </div>
      <div id="inputarea">
      <input id="name" value="<?php echo $name?>"/><br/>
<textarea rows="3" id="input">
</textarea>
        <button id="say">送信</button>
      </div>
    </div>
  </body>
</html>
