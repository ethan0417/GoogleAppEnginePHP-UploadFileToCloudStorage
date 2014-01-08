<html>
  <body>
    <?php

    require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
    use google\appengine\api\cloud_storage\CloudStorageTools;

    $options = [ 'gs_bucket_name' => 'example-images' ];
    $upload_url = CloudStorageTools::createUploadUrl('/upload_handler.php', $options);
    ?>
    <form action="<?php echo $upload_url?>" enctype="multipart/form-data" method="post">
      Files to upload: <br>
      <input type="file" name="uploaded_files" size="40">
      <input type="submit" value="Send">
    </form>
  </body>
</html>
<?
//echo 'Hello world!';
/*=========================================
require_once 'google/appengine/api/users/UserService.php';

  use google\appengine\api\users\User;
  use google\appengine\api\users\UserService;

  $user = UserService::getCurrentUser();

  if ($user) {
    echo 'Hello, ' . htmlspecialchars($user->getNickname());
  }else {
    header('Location: ' .
    UserService::createLoginURL($_SERVER['REQUEST_URI']));
  };
*/
/*=========================================
require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
use google\appengine\api\cloud_storage\CloudStorageTools;
$options = [ 'gs_bucket_name' => 'example-images' ];
$upload_url = CloudStorageTools::createUploadUrl('/upload_handler.php', $options);
<form action="<?php echo $upload_url?>" enctype="multipart/form-data" method="post">
  Files to upload: <br>
  <input type="file" name="uploaded_files" size="40">
  <input type="submit" value="Send">
</form>
*/
