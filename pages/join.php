<?php
include('../config.php');//get DB connection

require_once(__DIR__.'/../classes/Database.php');//mostly for DB connections... mostly...
//initialize classes
if(!isset($database)){$database = new Database();}//initialize database - why not....


?>
<style>
    /**
    Inline styles here
    **/
    .mb-0{
        margin-bottom: 0px;/** example **/
    }
    #example-id{
        
    }

    .upload-btn {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 16px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .upload-btn:hover {
        background-color: #3e8e41;
    }

</style>

<section id="join" class="bg-grey">
    <div class="container-fluid" data-aos="fade-up">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6">
                <h2 class="text-black font-weight-bold display-4 text-center">Join Up!</h2>
                <p class ="display-8 text-black text-center">
                    Wondering how to join on our next adventure? All you have to do is fill out the information below and we'll get back to you as soon as we can! Think we're taking awhile or have any questions? Find us on the Contact Page!
                </p>
                <div id="result" class="mt-2 mb-2 text-black"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <form class="form form-floating callback-form form">
                        <div class="form-floating mb-4 mt-4">
                            <input type="text" class="form-control" id ="name" placeholder="Name" autocomplete ="name" required >
                            <label for="name" class="text-black label-top">Name (Required)</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="phone" class="form-control" id ="phone" placeholder="phone" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" autocomplete="phone" required>
                            <label for="phone" class="text-black label-top">Phone #(Required)</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="email" class="form-control" id ="email" placeholder="Email Address" autocomplete="email" required>
                            <label for="email" class="text-black label-top">Email (Required)</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text"  class="form-control" id ="social" placeholder="social" autocomplete="social">
                            <label for="social" class="text-black label-top">Socials</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id ="experience" pattern="[0-9]{2}" placeholder="experience" autocomplete="experience">
                            <label for="experience" class="text-black label-top"># of Years Experience</label>
                        </div>
                        <div class="form-floating mb-4">
                            <p class ="display-8 text-black">
                                Have you ever been a trail guide?
                            </p>
                        </div>
                        <div>
                            <input type="radio" id ="rad" value="yes" >
                            <label for="yesCheck" class="text-black">Yes</label>
                        </div>
                        <div>
                            <input type="radio" id ="rad" value="no" >
                            <label for="noCheck" class="text-black">No</label>
                        </div>
                        <div class="form-floating mb-4">
                            <textarea type="textarea" class="form-control" id ="addinfo" rows="4" cols="40" placeholder="addinfo" autocomplete="addinfo"></textarea>
                            <label for="addinfo" class="text-black label-top">Additional Info</label>
                        </div>
                        <div class="form-floating mb-4">
                            <button id="joinBtn" class="btn btn-outline text-black">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input class="upload-btn" type="submit" value="Upload Image" name="submit">
</form>
