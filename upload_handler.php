<!DOCTYPE html>
<html>
  <head>
    <meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=UTF-8">
  </head>
  <body>
<?php
  header('Content-Type: text/plain; charset=UTF-8');
  
  require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
  use google\appengine\api\cloud_storage\CloudStorageTools;

  $gs_tmpName = $_FILES["uploaded_files"]['tmp_name'];
  $aaa = $_POST['fname'];
  $bbb = mb_convert_encoding($aaa, "UTF-8", "AUTO");
  //echo "<pre>",print_r($_FILES),"</pre>";
  //echo "<pre>",print_r($_POST),"</pre>";
  $ccc = urlencode($bbb);
  move_uploaded_file($gs_tmpName, "gs://example-images/".$ccc);
?>
<?php
  // getImageServingUrl. get images file url, but it looks like small than original.
  $imagesFile = CloudStorageTools::getImageServingUrl('gs://example-images/'.$ccc);
  echo $imagesFile;
  echo '<br>';
?>
<?php
  // getPublicUrl
  $options = [ "gs" => ["acl" => "public-read"]];
  $ctx = stream_context_create($options);
  file_put_contents('gs://example-images/'.$ccc , $ctx);
  $imagesFile1 = CloudStorageTools::getPublicUrl('gs://example-images/'.$ccc , true);
  echo $imagesFile1;
  echo '<br>';
?>
  <img src='<?php echo $imagesFile ?>'>
  <img src='<?php echo $imagesFile1 ?>'>
  </body>
</html>
