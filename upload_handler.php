<!DOCTYPE html>
<html>
   <head>
      <meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">
   </head>
   <body>
  <?php
    //header('Content-Type: text/plain; charset=utf-8');

    $gs_tmpName = $_FILES["uploaded_files"]['tmp_name'];

    $aaa = $_POST['fname'];
    $bbb = mb_convert_encoding($aaa, "UTF-8", "BIG5");

    //echo "<pre>",print_r($_FILES),"</pre>";
    //echo "<pre>",print_r($_POST),"</pre>";
    echo $aaa;
    echo $bbb;
    echo "111150桌布.jpg";
    echo "大大安安幾睡住哪";
    move_uploaded_file($gs_tmpName, "gs://example-images/".$bbb);
  ?>
   </body>
</html>
