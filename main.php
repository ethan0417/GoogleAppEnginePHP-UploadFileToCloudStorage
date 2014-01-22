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
      $options = [ 'gs_bucket_name' => 'example-images' ];
      $upload_url = CloudStorageTools::createUploadUrl('/upload_handler.php', $options);
    ?>
    <script>
      function date(){
        var Ary = document.uploadf.uploaded_files.value.split('\\');
        document.uploadf.fname.value = Ary[Ary.length-1];
        return true;
      };
    </script>
    <form action="<?php echo $upload_url?>" enctype="multipart/form-data" method="post" onsubmit="return date()" name='uploadf' accept-charset="ISO-8859-1">
      Files to upload: <br>
      <input type="file" name="uploaded_files">
      <input type="hidden" name="fname">
      <input type="submit" value="Send">
    </form>
  </body>
</html>
