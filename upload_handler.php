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
  
  //move_uploaded_file($gs_tmpName, "gs://example-images/".$ccc);

  // Set Image ACL
  $options = [ "gs" => ["Content-Type" => "image/jpeg", "acl" => "public-read"]];
  $ctx = stream_context_create($options);
  // Use rename method to add ACL setting and move file to google cloud storage.
  rename($gs_tmpName, "gs://example-images/".$ccc, $ctx);
  
  // getImageServingUrl. get images file url, but it looks like small than original.
  $imagesFile = CloudStorageTools::getImageServingUrl('gs://example-images/'.$ccc);
  echo '這是getImageServingUrl的檔案路徑';
  echo '<br>';
  echo $imagesFile;
  echo '<br>';
  
  // get original images for google cloud storage.
  $imagesFile_original = imagesPublicURL('example-images', $ccc, '');
  echo '這是imagesFile_original回傳回來的';
  echo '<br>';
  echo $imagesFile_original;
  echo '<br>';

  // put image file info and getPublicUrl
  function imagesPublicURL($bucketName, $imageFile, $imageThumbName){
    $imagesFile1 = CloudStorageTools::getPublicUrl('gs://'.$bucketName.'/'.$imageThumbName.$imageFile , true);
    echo '這是imagesPublicURL產生的，利用getPublicUrl的路徑';
    echo '<br>';
    echo $imagesFile1;
    echo '<br>';
    return $imagesFile1;
  }

  // 產生縮圖並上傳
  /*
  $checkThumb = mkthumb_google($imagesFile_original, 'example-images', 120);
  if( $checkThumb === 'ok'){
    echo 'generator thumb pic OK';
  }else{
    echo 'generator thumb pic Fail';
  };
  */

  //---------------------- 製作縮圖函式,並上傳至google cloud storage -----------------------------
  // Edit thumb picture to Google cloud storage.
  //$orig, $thumb是原始圖與縮圖的路徑與檔名, $maxLength 是縮圖的最大長度
  function mkthumb_google( $orig, $thumb, $maxLength ){
    $ext = strrchr($orig, ".");
    //依照副檔名, 使用不同函式將原始照片載入記憶體
    // 取得cloud storage的圖片，帶入下面進行縮小
    switch ($ext){
    case '.jpg':
      $picSrc = imagecreatefromjpeg($orig);
      break;
    case '.png':
      $picSrc = imagecreatefrompng($orig);
      break;
    case '.gif':
      $picSrc = imagecreatefromgif($orig);
      break;
    case '.bmp':
      $picSrc = imagecreatefrombmp($orig);
      break;
    default:
      //傳回錯誤訊息
      return "不支援 $ext 圖檔格式, 無法製作 $orig 的縮圖"; 
    }
    // 取得原始圖的高度 ($picSrc_y) 與寬度 ($picSrc_x)
    // 依照 $maxLength 參數, 計算縮圖應該使用的高度 ($picDst_y) 與寬度 ($picDst_x)
    // intval() 可取得數字的整數部分
    $picSrc_x = imagesx($picSrc);
    $picSrc_y = imagesy($picSrc);
    $picDst_x = $maxLength;
    $picDst_y = intval($picSrc_y / $picSrc_x * $maxLength);
    
    //在記憶體中建立新圖
    $picDst = imagecreatetruecolor($picDst_x, $picDst_y);
    
    //將原始照片複製並且縮小到新圖
    imagecopyresized($picDst, $picSrc, 0, 0, 0, 0,
                     $picDst_x, $picDst_y, $picSrc_x, $picSrc_y);
    //將新圖寫入 $thumb 參數指定的縮圖檔名
    imagejpeg($picDst, 'gs://'.$thumb.'/thumb'.$orig);
    //$thumbImage = imagesPublicURL($thumb, $picDst, 'thumb');
    echo '<br>';
    echo $picDst;
    echo '<br>';
    echo '這是縮圖裡面內容產生的';
    echo '<br>';
    //echo $thumbImage;
    echo '<br>';
    return 'ok';
  }

  
?>
  <img src='<?php echo $imagesFile ?>'>
  <img src='<?php echo $imagesFile_original ?>'>
  </body>
</html>
