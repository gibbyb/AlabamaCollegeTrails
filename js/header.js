
/* global AOS */
document.addEventListener('DOMContentLoaded', () => {
      "use strict";
    //preloader
    $(window).on('load',function() {
        $('#preloader').css('background-color','transparent');
        $('#preloader').fadeOut('fast');
    });
    
    //Sticky header on scroll
    const selectHeader = document.querySelector('#header');
    if(selectHeader){
    document.addEventListener('scroll', () => {
        adjustHeader();
    });
    adjustHeader();
    function adjustHeader(){
        if(window.scrollY > 250){
                selectHeader.classList.add('sticked');
                selectHeader.classList.add('fixed-top');
                selectHeader.classList.add('align-items-center');
                selectHeader.classList.add('d-flex');
                selectHeader.classList.add('d-shrunk');
                selectHeader.classList.remove('position-absolute');
        }else if(window.scrollY < 100){
            selectHeader.classList.remove('sticked');
            selectHeader.classList.remove('fixed-top');
            selectHeader.classList.remove('align-items-center');
            selectHeader.classList.remove('d-flex');
            selectHeader.classList.remove('d-shrunk');
            selectHeader.classList.add('position-absolute');
        }
        if(window.scrollY > 300)
            selectHeader.classList.add('d-grown');
        if(window.scrollY < 175)
            selectHeader.classList.remove('d-grown');
    }
    }
    //Mobile nav toggle
    const mobileNavShow = document.querySelector('.mobile-nav-show');
    const mobileNavHide = document.querySelector('.mobile-nav-hide');
    document.querySelectorAll('.mobile-nav-toggle').forEach(el => {
      el.addEventListener('click', function(event) {
        event.preventDefault();
        mobileNavToogle();
      });
    });
    function mobileNavToogle() {
      document.querySelector('body').classList.toggle('mobile-nav-active');
      mobileNavShow.classList.toggle('d-none');
      mobileNavHide.classList.toggle('d-none');
    }
    $('.navbar-toggler').on('click',function(){
        if($(this).attr('aria-expanded') === 'true') {
            $(this).attr('aria-expanded','false');
            $('.navbar-collapse').removeClass('show');
        }
    });
    /**
     * Toggle mobile nav dropdowns
     */
    const navDropdowns = document.querySelectorAll('.navbar .dropdown > a');

    navDropdowns.forEach(el => {
      el.addEventListener('click', function(event) {
        if (document.querySelector('.mobile-nav-active')) {
          event.preventDefault();
          this.classList.toggle('active');
          this.nextElementSibling.classList.toggle('dropdown-active');

          let dropDownIndicator = this.querySelector('.dropdown-indicator');
          dropDownIndicator.classList.toggle('bi-chevron-up');
          dropDownIndicator.classList.toggle('bi-chevron-down');
        }
      });
    });

    //scroll to section functionality
    $("a[href^='#']").click(function(e) {
        e.preventDefault();
        if($(this).attr("href").length > 1){
            scroll($($(this).attr("href")).offset().top);
        }
    });
    //scroll to id in url
    scroll_url();
    function scroll_url(){
        var url = document.location.href;
        var hash = url.substring(url.indexOf('#') + 1);
        if(url.indexOf('#') !== -1 && hash.length > 1 && $('#'+hash).length)
            scroll($('#'+hash).offset().top-150);
    }
    /**
     * Scroll top button
     */
    const scrollTop = document.querySelector('.scroll-top');
    if (scrollTop) {
      const togglescrollTop = function() {
        window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
      };
      window.addEventListener('load', togglescrollTop);
      document.addEventListener('scroll', togglescrollTop);
      $(scrollTop).on('click',function(e){
          e.preventDefault();
          scroll(0);
      });
    }
    function scroll(position){
        window.scrollTo({
            top: position,
            behavior: 'smooth'
          });
    }
    
});