<?php
include('../config.php');//get DB connection

require_once(__DIR__.'/../classes/Database.php');//mostly for DB connections... mostly...
//initialize classes
if(!isset($database)){$database = new Database();}//initialize database - why not....
?>

<section id="join" class="bg-grey">
    <div class="container-fluid" data-aos="fade-up">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6">
                <h2 class="text-black font-weight-bold display-4 text-center">Join Up!</h2>
                <p class ="display-8 text-black text-center">
                    Wondering how to join on our next adventure? All you have to do is fill out the information below and we'll get back to you as soon as we can! Think we're taking awhile or have any questions? Find us on the Contact Page!
                </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <form class="form form-floating callback-form form">
                        <div class="form-floating mb-4 mt-4">
                            <input type="text" class="form-control" id ="name" placeholder="Name" autocomplete ="name" >
                            <label for="name" class="text-black label-top">Name</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="tel" class="form-control" id ="phone" placeholder="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" autocomplete="tel" required>
                            <label for="tel" class="text-black label-top">Phone #</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="email" class="form-control" id ="email" placeholder="Email Address" autocomplete="email">
                            <label for="email" class="text-black label-top">Email</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id ="socialmediainfo" placeholder="socialmediainfo" autocomplete="socialmediainfo">
                            <label for="socialmediainfo" class="text-black label-top">Socials</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id ="experience" pattern="[0-9]" placeholder="experience" autocomplete="experience">
                            <label for="experience" class="text-black label-top"># of Years Experience</label>
                        </div>
                        <div class="form-floating mb-4">
                            <p class ="display-8 text-black">
                                Have you ever been a trail guide?
                            </p>
                        </div>
                        <div>
                            <input type="checkbox" name="yes" id ="yesCheck" >
                            <label for="yesCheck" class="text-black">Yes</label>
                        </div>
                        <div>
                            <input type="checkbox" name="no" id ="noCheck" checked='checked'>
                            <label for="noCheck" class="text-black">No</label>
                        </div>
                        <div class="form-floating mb-4">
                            <textarea type="textarea" class="form-control" id ="experience" rows="4" cols="40" placeholder="experience" autocomplete="experience"></textarea>
                            <label for="experience" class="text-black label-top">Additional Info</label>
                        </div>
                        <div class="form-floating mb-4">
                            <button id="joinBtn" class="btn btn-outline text-black">Submit</button>
                        </div>
                        <div id='result'></div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</section>


<div class="user-photos">
    <!-- Photo Gallery -->
    <h2 class="gallery-header"><br>Explore the Trails Through Our Members' Captivating Photos!</h2>
    <div id="photo-gallery">
        <?php
        $directory = $_SERVER['DOCUMENT_ROOT'] . "/img/"; // Directory containing the images, absolute path
        $pattern = '/^userphoto\d+\.jpg$/i'; // Regular expression pattern to match the file names

        if (is_dir($directory)) {
            $files = scandir($directory);

            foreach ($files as $file) {
                if (preg_match($pattern, $file)) {
                    // Display the image
                    echo "<img src='/img/{$file}' alt='User uploaded photo' style='width:200px; height:auto; margin:10px;' />";
                }
            }
        } else {
            echo "<p>Unable to read the image directory.</p>";
        }
        ?>
    </div>

    <h2 class="gallery-header">Have photos you would like to share? Upload them here!<br></h2>
    <form action="../workers/upload.php" method="post" enctype="multipart/form-data">
    <div class="upload-container">
      <label for="fileToUpload" class="file-input-label">Choose file</label>
      <input type="file" name="fileToUpload" id="fileToUpload" class="file-input">
      <input class="upload-btn" type="submit" value="Upload Image" name="submit">
    </div>
  </form>
</div>





