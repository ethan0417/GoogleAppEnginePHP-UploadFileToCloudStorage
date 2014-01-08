<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  </head>
  <body>
    <?php
      var_dump($_FILES);
      $gs_name = $_FILES["uploaded_files"]['tmp_name'];
      $gs_oldname = $_FILES["uploaded_files"]['name'];

      move_uploaded_file($gs_name, iconv("big5", "utf-8", "gs://example-images/".$gs_oldname ));
    ?>
  </body>
</html>
