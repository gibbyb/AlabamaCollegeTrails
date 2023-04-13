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
</style>

<!-- start contact section -->
<section id='contact' class="bg-white">
     <div class="container-fluid" data-aos="fade-up">
        <div class="container" >
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="text-black font-weight-bold d-inline-block text-uppercase border-bottom border-5 border-bright">Get In Touch</h2>
                    <h2 class="display-4 text-black d-inline-block text-uppercase">We need volunteers!</h2>
                    <p class="display-7 text-black">
                        Submit this form and one of our senior member will get back to you.
                    </p>
                </div>
                <div class="col-lg-4">
                    <form class="form form-floating callback-form form">
                        <div class="form-floating mb-4 mt-4">
                            <input type="text" class="form-control" id="name" placeholder="Your Name" autocomplete="name" >
                            <label for="name" class="text-black label-top">Your Name</label>
                          </div>
                        <div class="form-floating mb-4">
                            <input type="tel" class="form-control" id="tel" placeholder="Phone Number" autocomplete="tel" >
                            <label for="tel" class="text-black label-top">Phone Number</label>
                          </div>
                        <div class="form-floating mb-4">
                            <input type="email" class="form-control" id="email" placeholder="name@example.com" autocomplete="email" >
                            <label for="email" class="text-black label-top">Email</label>
                          </div>
                        <div class="form-floating mb-4">
                            <textarea type="text" class="form-control" id="message" placeholder="Message" autocomplete="none" ></textarea>
                            <label for="message" class="text-black label-top">Your Message</label>
                          </div>
                        <button id="contact_us_btn" class="btn btn-outline text-black">Submit</button>
                    </form>
                    <div id="result" class="mt-3"></div>
                </div>
            </div>
        </div>
     </div>
</section><!-- end contact section -->