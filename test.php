<!DOCTYPE html>
<html>
  <head>
    <meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=UTF-8">
  </head>
  <body>
  <?php
    header('Content-Type: text/plain; charset=UTF-8');
    $options = [ "gs" => [ "Content-Type" => "text/plain","acl" => "public-read" ]];
    $ctx = stream_context_create($options);
    file_put_contents("gs://example-images/hello.txt", "Hello", 0, $ctx);
  ?>
  </body>
</html>
