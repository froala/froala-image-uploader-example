<?php
/**
 * store_img_link.php file
 * 
 **/

try {
    //Receive the image link
    $link = json_encode($_POST['img_link']);
    //Store image link in a file
    file_put_contents(__DIR__ . '/storage/user1/images/image_name.txt', $link);
    //Return success message to the client.
    echo stripslashes(json_encode('Success'));

  }
  catch (Exception $e) {
    http_response_code(404);
}
  
?>