<?php
/**
 * delet_image.php file
 * 
 **/

require __DIR__ . '/vendor/froala/wysiwyg-editor-php-sdk/lib/FroalaEditor.php';

try {
    /*
    *set a flag to indicate if the image to be deleted is the profile image
    * Used when deleteing image from image manager
    */
    $is_profile_img = false;

    $file_path = __DIR__ . '/storage/user1/images/image_name.txt';

    //get the image to be deleted link
    $deleted_img_link = $_POST['src'];

    //Delete image from the server
    $response = FroalaEditor_Image::delete($deleted_img_link);

    //Check the image link is the profile image link or not
    //get the used profile image
    $profile_img_link = file_get_contents($file_path);
    //if a profile image is used and it is the one that will be deleted
    if($profile_img_link !== false && !empty($profile_img_link) && json_decode($profile_img_link) === $deleted_img_link){
      //this is the image used for profile
      $is_profile_img = true;
      //Delete the image link from the txt file
      file_put_contents($file_path, null);
    }
        
    //Return the response to the client.
    echo stripslashes(json_encode(["is_profile_img"=>$is_profile_img]));
    
  }
  catch (Exception $e) {
    http_response_code(404);
}
  
?>