![Froala image logo](resources/static/froala-image-logo.png)

# [Froala image uploader example](https://froala.com/image-uploader/)

![Froala image uploader](resources/static/FRO-image-uploader.gif)

The supporting SDK and editor source files are being installed using composer in this example. You can download those directly from https://github.com/froala/wysiwyg-editor-php-sdk and https://github.com/froala/wysiwyg-editor into your project folder and update the path to files respectively.

## Dependencies

PHP version >= 5.4.0 is required.

The following PHP extensions are required:

* fileinfo
* imagick

Note: imagick extension is requried for resizing the image on the server-side, if you will not use it and don't want to enable it you can remove it form "project folder/vendor/froala/wysiwyg-editor-php-sdk/lib/FroalaEditor.php" file.

## Steps to run the project

- Download the files in to the project folder in a server enviornment supporting PHP
- Run command `composer install` to install Froala SDK and editor source dependecies.
- Open project in browser to see the results
- Note: In this example we are using https://cors-anywhere.herokuapp.com/ to enable uploading images from external URL. In production you need to change this to the proxy server you are using. for testing you have to do the following steps:
  - Open the link https://cors-anywhere.herokuapp.com/corsdemo on a new page
  - Click on "Request temporary access to the demo server" button


## Documentation
 * [Toturial](https://froala.com/image-uploader/handle-user-profile-image-php-tutorial/)
 * [Froala Editor API](https://froala.com/wysiwyg-editor/docs/api/)
 * [SDK documentation](https://www.froala.com/wysiwyg-editor/docs/sdks/php)
 * [Froala Image plugin documentation](https://froala.com/image-plugin/)
 * [Froala Image Manager plugin documentation](https://froala.com/image-manager-plugin/)

## Main features ✅

 - Upload from device, drag-and-drop or external URL.
 - Image Manager Included.
 ![Froala Image Manager](resources/static/image-manager.gif)

 - Support Amazon S3 uploads.
 - Image previews.
 - Progress updates.
 - Looks nice in any form. The placeholder image can be any image from your choice.
 ![Froala Image placeholder](resources/static/image-uploader-link.gif)

 - Image resizing.
 ![Froala Image Resizing](resources/static/image-uploader-resize.gif)

 - File validation and error handling.

 ![Froala Image validation](resources/static/Upload-form-error.png)

 - Well tested

## License

The Froala image uploader is licensed under MIT license.  However, in order to use Froala WYSIWYG HTML Editor for other propuses than image uploader, you should purchase a [license](http://froala.com/wysiwyg-editor/pricing) for it.

## Help
- Found a bug or have some suggestions? Just submit an [issue](https://github.com/froala/froala-image-uploader-example/issues).
- Having trouble with your integration? [Contact Froala Support team](http://froala.com/wysiwyg-editor/contact).
