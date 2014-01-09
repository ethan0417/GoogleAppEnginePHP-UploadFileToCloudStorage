<?php
    header('Content-Type: text/plain; charset=UTF-8');

    $gs_tmpName = $_FILES["uploaded_files"]['tmp_name'];

    $aaa = $_POST['fname'];
    $bbb = mb_convert_encoding($aaa, "UTF-8", "AUTO");

    //echo "<pre>",print_r($_FILES),"</pre>";
    //echo "<pre>",print_r($_POST),"</pre>";

    $ccc = urlencode($bbb);
    
    echo $bbb;
    echo '<br>';
    echo $ccc;    
    
    move_uploaded_file($gs_tmpName, "gs://example-images/".$ccc);
?>
