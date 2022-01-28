<?php
/**
 * upload.php file
 *
 **/

require_once __DIR__ . '/vendor/froala/wysiwyg-editor-php-sdk/lib/FroalaEditor.php';
$project_folder = str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\', '/', __DIR__));

try {
    $options = array(
        'validation' => array(
          'allowedExts' => array('jpeg', 'jpg', 'png'),
          'allowedMimeTypes' => array('image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png')
        )
      );

    // Store the image.
    $response = FroalaEditor_Image::upload($project_folder . '/storage/user1/images/', $options);
    //return the response
    echo stripslashes(json_encode($response));
}
    catch (Exception $e) {
    http_response_code(404);
}

?>
