<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Froala used as image input</title>
    <!-- Stylesheets-->
    <link rel="stylesheet" href="vendor/froala/wysiwyg-editor/css/froala_editor.min.css">
    <link rel="stylesheet" href="vendor/froala/wysiwyg-editor/css/plugins/image.min.css">
    <link rel="stylesheet" href="vendor/froala/wysiwyg-editor/css/plugins/image_manager.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
    
    <h1>Update Your Profile</h1>
    <!-- start example -->
    <div class="well" style="max-width: 400px;">
    <form action="/person.php" method="post">
        <div class="form-group">
        <label for="">Upload Photo</label>
        <figure>
            <?php
            /**
             * Update $file_path value depending on the folder and path the project is placed.
             */
                $file_path = __DIR__ . '/storage/user1/images/image_name.txt';
                $response = file_get_contents( $file_path);
                if($response === false || empty($response)){
                    $img_src = "https://i.ibb.co/g9gGYPX/avatar-g177d581fb-640.png";
                }else{
                    $img_src = json_decode($response);
                }
                    
            ?>
            <img id="logo" src="<?php echo $img_src;  ?>" alt="User placeholder" height="100" >
            <figcaption>Click on the above image to edit or replace</figcaption>
        </figure> 
        </div>
        <div class="form-group">
        <label for="firstname">First Name</label>
        <input class="form-control" type="text" name="firstname" placeholder="Enter your first name">
        </div>
        <div class="form-group">
        <label for="lastname">Last Name</label>
        <input class="form-control" type="text" name="lastname" placeholder="Enter your last name">
        </div>
        <div class="form-group">
        <label>Gender</label>
        <label class="checkbox-inline">
            <input type="radio" name="gender" id="male" value="male">
            Male
        </label>
        <label class="checkbox-inline">
            <input type="radio" name="gender" id="female" value="female">
            Female
        </label>
        </div>


        <input type="submit" class="btn btn-primary" value="Submit">
    </form>
    </div>
    <!--end example-->
    

    <!--JS Scripts-->
    <script src="vendor/froala/wysiwyg-editor/js/froala_editor.min.js"></script>
    <script src="vendor/froala/wysiwyg-editor/js/plugins/image.min.js"></script>
    <script src="vendor/froala/wysiwyg-editor/js/plugins/image_manager.min.js"></script>
    <script>
        const editor = new FroalaEditor('#logo',{
                            pluginsEnabled: ['image', 'imageManager'],
                            //image popup buttons
                            imageEditButtons: ['imageReplace', 'imageRemove'],
                            //Buttons for the popup menu which appears on imageReplace button click
                            imageInsertButtons: ['imageBack', '|', 'imageUpload', 'imageByURL', 'imageManager'],
                            //Set the request type
                            imageUploadMethod: 'POST',
                            // Set the image upload URL.
                            imageUploadURL: 'upload.php',
                            //Set Proxy to upload images from a URL
                            imageCORSProxy: 'https://cors-anywhere.herokuapp.com',
                            // Set the image delete URL.
                            imageManagerDeleteURL: 'delete_image.php',
                            // Set the image manager upload URL.
                            imageManagerLoadURL: 'image_manager.php',
                            // Set the image manager delete URL.
                            imageManagerDeleteURL: 'delete_image.php',

                            //Validation
                            //set image allowed types
                            imageAllowedTypes: ['jpeg', 'jpg', 'png'],

                            // Set max image size to 10MB.
                            imageMaxSize: 1024 * 1024 * 10,

                            events: {
                                'image.replaced': function ($img, response) {
                                    // this is the editor instance.
                                    console.log(this);

                                    //get the image link
                                    var imgLink = $img[0].src.replace(window.location.origin, '');
                                    //Send HTTP request to the server
                                    var request = new XMLHttpRequest();
                                    //set request type and target url
                                    request.open('POST', 'store_image_link.php', true);
                                    //Set the data that will be sent along with the request
                                    var data = new FormData();
                                    //send the link of the replaced image that needs to get stored 
                                    data.append('img_link', imgLink);
                                    //send the request with the data
                                    request.send(data);

                                    request.onload = function() {
                                    if (this.status >= 200 && this.status < 400) {
                                        // request Success!
                                        console.log ('Image successfully stored.');

                                    } else {
                                        // We reached our target server, but it returned an error
                                        var err = this.response;
                                        console.log ('Image delete problem: ' + JSON.stringify(err));
                                    }
                                    };

                                    //On request failure  
                                    request.onerror = function() {
                                        // There was a connection error of some sort
                                        var err = this.response;
                                            console.log ('Image delete problem: ' + JSON.stringify(err));
                                    };
                                },

                                //delete image from the server
                                'image.beforeRemove': function ($img) {
                                    //get the image link
                                    var imgLink = $img[0].src.replace(window.location.origin, '');
                                    //Send HTTP request to the server
                                    var request = new XMLHttpRequest();
                                    //set request type and target url
                                    request.open('POST', 'delete_image.php', true);
                                    //Set the data that will be sent along with the request
                                    var data = new FormData();
                                    //send the link of the replaced image that needs to get stored 
                                    data.append('src', imgLink);
                                    //send the request with the data
                                    request.send(data);

                                    request.onload = function() {
                                        if (this.status >= 200 && this.status < 400) {
                                            // Success!
                                            //set profile image to the placeholder image
                                            const placeholder = document.getElementById('logo');
                                            placeholder.src = "https://i.ibb.co/g9gGYPX/avatar-g177d581fb-640.png";
                                            //Display alert to the user
                                            alert ('Image was successfully deleted');

                                        } else {
                                            // We reached our target server, but it returned an error
                                            var err = this.response;
                                            console.log ('Image delete problem: ' + JSON.stringify(err));
                                        }
                                    };

                                    //On request failure  
                                    request.onerror = function() {
                                        // There was a connection error of some sort
                                        var err = this.response;
                                        console.log ('Image delete problem: ' + JSON.stringify(err));
                                    };
                                    //return false to prevent Froala from removing img src before the HTTP request is completed
                                    return false;
                                },

                                //delete image from the Image Manager
                                'imageManager.imageDeleted': function (response) {
                                    response = JSON.parse(response);
                                    if(response.is_profile_img){
                                        //replace profile image with the placeholder image
                                        const placeholder = document.getElementById('logo');
                                        placeholder.src = "https://i.ibb.co/g9gGYPX/avatar-g177d581fb-640.png";
                                    }
                                },    
                                
                            } //end events object

                        });
    </script>
</body>
</html>
