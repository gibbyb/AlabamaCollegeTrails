<?php
 require_once('config.php');//get config
/**
 * @package GulfCoastWebsites
 */
 $title = "Welcome";//default
 $subtitle = "";//default
 $heroImg = "events-hero.jpg";//default
if(str_contains(page, "calendar")){//calendar page variables
    $title = "Upcoming events";
    $subtitle = "Hiking , School, or Community Events";
}else if(str_contains(page, "locations")){//hiking page variables
    $title = "Hiking locations";
    $subtitle = "Great Hiking Locations";
    $heroImg = "hiking.jpg";//in the img folder
}else if(str_contains(page,"resources")){//resources page variables
    $title = "Resources";
    $subtitle = "Resources for Hikers";
    $heroImg = "resources.jpg";
}else if(str_contains(page,"contact")){//contact page variables
    $title = "Contact Us";
    $subtitle = "Don't be a stranger";   
    $heroImg = "contact.jpg";//in the img folder
}else if(str_contains(page,"join")){//join page variables
    $title = "Contact Us";
    $subtitle = "Don't be a stranger";   
    $heroImg = "contact.jpg";//in the img folder
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php print get_site_title(); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"/>
    <link rel="stylesheeet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.14.0/jquery.timepicker.min.css"/>
    <link rel="stylesheet" href="styles.css"/>
    <link rel="stylesheet" href="css/auxillary.css"/>
    <?php //loads custom css for specific pages
    if(str_contains(page,"calendar")){
        print '<link rel="stylesheet" href="css/calendar.css"/>';
        print '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css"/>';
    } 
    ?>
    <link rel="profile" href="https://gmpg.org/xfn/11">
</head>
<body>
    <div id="preloader"></div>
   
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="#">Features</a>
            <a class="nav-item nav-link" href="#">Pricing</a>
            <a class="nav-item nav-link disabled" href="#">Disabled</a>
          </div>
        </div>
    </nav>
    <main id="content" class="content">
        <?php if(page != "/"){ //hero header loads on all pages excepte the home page
            print '
        <section class="parrallax" id="calendar-hero d-flex align-items-center" style="background-image: url(../img/'. $heroImg .')">
            <div class="bg-block"></div>
            <div class="container container-header mt-5">
                <div class="row">
                    <div class="col-xxl-4">
                        <h1 data-aos="fade-up" class="h1 aos-init aos-animate text-white ">'. $title .'<span class="cursive">.</span></h1>
                        <h2 data-aos="fade-up" class="h2 aos-init aos-animate text-white ">'. $subtitle .'<span class="cursive">.</span></h2>
                    </div>
                </div>
            </div>
        </section>';
        }?>
