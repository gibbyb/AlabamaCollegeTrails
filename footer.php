<?php
?>
</main><!-- End main content -->
<footer class="index bg-green">
    <ul>
        <li ><a href="/locations">Where We Hike</a></li>
        <li ><a href="/resources">Hiking Resources</a></li>
        <li ><a href="/calendar">Calendar of Events</a></li>
        <li  ><a href="/contact">Contact Us</a></li>
        <li ><a href="/join">How To Join</a></li>
    </ul>
</footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js?ver=3.6.3"></script>
    <script src="js/header.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js?ver=5.2.3"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js?ver=5.2.3"></script>
    <?php 
    if(str_contains(page,"calendar")){//loads custom js for specific pages
        print "<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>";
        print '<script src="js/calendar.js"></script>';
    }else
    if(str_contains(page,"contact")){
        print '<script src="js/contact.js"></script>';
    }
    ?>
</body>
</html>