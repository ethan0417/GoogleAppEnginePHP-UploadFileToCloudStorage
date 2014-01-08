<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=UTF-8">
   </head>
   <body>
<?php
   header('Content-Type: text/plain; charset=utf-8');
   //var_dump($_FILES);
   echo "<pre>",print_r($_FILES),"</pre>";
   $gs_tmpName = $_FILES["uploaded_files"]['tmp_name'];
   $gs_originalName = mb_convert_encoding($_FILES["uploaded_files"]['name'], "UTF-8", "AUTO") ;
   $gs_originalName2 = iconv("big5","utf-8",$_FILES["uploaded_files"]['name']) ;
   //$test = mb_convert_encoding("我就是中文啦ddd喵喵的", "UTF-8", "AUTO") ;
   $aaa = basename($_POST['fname']);
   $bbb = mb_convert_encoding($aaa, "big5", "UTF-8");
   //$aaa = basename('C:\fakepath\50桌布-1920.1220+19.jpg');
   //$bbb = basename('/fakepath/50桌布-1920.1220+19.jpg');
   echo "<br>";
   echo "<br>";
   echo $gs_originalName;
   echo "<br>";
   echo "<br>";
   echo $gs_originalName2;
   echo "<br>";
   echo "<br>";
   echo "<pre>",print_r($_POST),"</pre>";
   echo "<br>";
   echo "<br>";
   echo $aaa;
   echo "<br>";
   echo "<br>";
   echo $bbb;
   //move_uploaded_file($gs_tmpName, iconv("utf-8", "big5", "gs://example-images/".$gs_originalName));
   //move_uploaded_file($gs_tmpName, "gs://example-images/".$gs_originalName);
   move_uploaded_file($gs_tmpName, "gs://example-images/".$bbb);
?>
   </body>
</html>
