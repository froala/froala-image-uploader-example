<?php
require __DIR__ . '/vendor/froala/wysiwyg-editor-php-sdk/lib/FroalaEditor.php';

$project_folder = str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\', '/', __DIR__));

// Load the images.
try {
    $response = FroalaEditor_Image::getList($project_folder . '/storage/user1/images/');
    echo stripslashes(json_encode($response));
  }
  catch (Exception $e) {
    http_response_code(404);
}

?>
