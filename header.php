<?php
 require_once(__DIR__. '/config.php');//get config
/**
 * @package GulfCoastWebsites
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php print get_site_title(); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"/>
    <link rel="stylesheet" href="styles.css"/>
    <link rel="stylesheet" href="css/header.css"/>
    <link rel="profile" href="https://gmpg.org/xfn/11">
</head>
<body>
    <div id="content" class="">
    <header id="header" class="header full-width-layout position-absolute bg-green mb-3">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="<?php print get_site_url(); ?>" class="logo d-flex align-items-center ps-5">
                <img src="img/logo.png" alt="logo"  width="50px" height="50px">                                           
                <p class="logo-txt text-white col-6">
                    <span class="row">
                        <span class="col-12 text-gradient cursive">Alabama</span>
                        <span class="col-12 logo-txt-sm ">Hiking Trails</span>                                
                    </span>
                </p>
            </a>
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            <!-- start burger menu -->
            <nav id="navbar" class="navbar pe-5">
                <ul id="menu-custom-menu" class="mt-md-0 mt-sm-5">
                    <li class="menu-item"><a href="../" aria-current="page">Home</a></li>
                    <li class="menu-item"><a href="/locations">Hiking</a></li>
                    <li class="menu-item"><a href="/resources">resources</a></li>
                    <li class="menu-item"><a href="/calendar">Calendar</a></li>
                    <li class="menu-item"><a href="/join">Join</a></li>
                    <li  class="menu-item"><a href="/contact">Contact</a></li>
                </ul>
            </nav>        
        </div>
    </header>