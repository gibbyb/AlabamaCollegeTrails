<?php
require_once __DIR__.'/../config.php';
if(!isset($database)){$database = new Database();}//initialize database
/* 
 * licensed under the GPL.
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="" >
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="icon" type="image/png" href="<?php print get_template_directory_uri(). '/favicon.ico'?>">
    <?php wp_head(); ?>
    <?php print('<time style="display:none" datetime="'.date('c').date('m/d/Y').'">'.date('c').date('m/d/Y').'</time>');?>
</head>
<body <?php body_class('page-index'); ?>>
    <section id="proposals" class="bg-grey">
        <div class="row noprint">
            <div class="container-fluid d-flex">
                <div class="col-2 border-block p-3 bg-light nav-left shadow-sm">
                    <div class="pt-5">
                        <a href="<?php print get_site_url(); ?>" class="logo d-flex align-items-center col-12">
                            <img src="<?php print get_template_directory_uri();?>/images/logo.png" alt="logo" class="logo-img">                                           
                            <p class="logo-txt col-6">
                                <span class="row">
                                    <span class="col-12 text-dark "><?php  print 'Gulf Coast Websites'; ?></span>
                                    <span class="col-12 logo-txt-sm text-gradient cursive"><?php  print 'More than pretty pictures'; ?></span>                                
                                </span>
                            </p>
                        </a>
                    </div>
                    <div class="container d-flex flex-column flex-shrink-0 h-75">
                        <hr class=""/>
                        <div class="menu pt-3 mb-auto">
                            <ul class="proposal-menu list-inline text-dark mb-auto">
                                <li class=""><a href="#plans-section" id="plans" class="viewing"><i class="bi bi-gift me-2"></i>Plans & Pricing Guide</a></li>
                                <li class=""><a href="#website-section" id="website"><i class="bi bi-globe2 me-2"></i>Website Design</a></li>
                                <li class=""><a href="#local-section" id="local"><i class="bi bi-house me-2"></i>Local SEO</a></li>
                                <li class=""><a href="#organic-section" id="organic"><i class="bi bi-search me-2"></i>Organic SEO</a></li>
                                <li class=""><a href="#ads-section" id="ads"><i class="bi bi-search me-2"></i>Search Ads</a></li>
                                <li class=""><a href="#social-section" id="social"><i class="bi bi-grid me-2"></i>Social Ads</a></li>
                            </ul>
                        </div>
                        <hr class="mt-auto"/>
                        <div class="login d-flex">
                            <a href="#" id="signin" class="text-orange">Login</a>
                            <a href="#" id="btn-register" class="text-orange ps-4">Register</a>
                        </div>
                    </div>
                </div>
                <div class="col-8"></div>
            </div>
        </div>
        <div class="row">
            <div class="container-fluid d-flex">
                <div class="w-280 h-100 border-block noprint nomobile"><!-- dummy container -->
                    <div class="w-100 h-100">
                        <img src="<?php print get_template_directory_uri();?>/images/logo-new-stroke.png" alt="logo" class="logo-img">                                           
                    </div>
                </div>
                <div class="proposal-page-container col-sm-12 col-lg-8">
                    <div class="proposal-page-header h5 text-dark noprint">Plans & Pricing Guide</div>
                    <?php $database->renderPage (theme_path. 'pages/sections/brochure/letter-section.php'); ?>
                    <div class="proposal-page-header h5 text-dark noprint">Website Design</div>
                    <?php $database->renderPage (theme_path. 'pages/sections/brochure/web-design-section.php'); ?>
                    <div class="proposal-page-header h5 text-dark noprint mt-5">Local SEO</div>
                    <?php $database->renderPage (theme_path. 'pages/sections/brochure/local-section.php'); ?>
                    <div class="proposal-page-header h5 text-dark noprint mt-5">Organic SEO</div>
                    <?php $database->renderPage (theme_path. 'pages/sections/brochure/organic-section.php'); ?>
                    <div class="proposal-page-header h5 text-dark noprint mt-5">Ads</div>
                    <?php $database->renderPage (theme_path. 'pages/sections/brochure/ads-section.php'); ?>
                    <div class="proposal-page-header h5 text-dark noprint mt-5">Social</div>
                    <?php $database->renderPage (theme_path. 'pages/sections/brochure/social-section.php'); ?>
                </div>
            </div>
        </div>
    </section>
    <?php $database->renderPage(__DIR__."/sections/login.php");//this section is a pop-up?>
<?php get_footer();