<?php

/* 
 * licensed under the GPL.
 */
require_once __DIR__.'/../../config.php';
?>
<section id="addEvent" class="d-none">
    <div class="overlay-dark active">
    </div>
    <div class="mx-auto my-auto bg-white border-block center-horizontal center-vertical event-box bg-grey">
        <div class="col-12 d-flex justify-content-end me-5 login-container">
            <i class="bi bi-x me-3 text-black ts-xxl" id="event-close"></i>
        </div>
        <div class="container p-5 pt-0">
            <div class="row">
                <div class="col-12 text-center">
                    <h4 class="h4 border-highlight mb-5">Add Event</h4>
                </div>
                <div class="col-12 mb-2">
                    <label for="event_title">Event Title*</label>
                    <input type="text" id="event_title" class="checkout_input">
                </div>
                <div class="col-6 mb-2">
                    <label for="event_url">Event URL (if applicable)</label>
                    <input type="text" id="event_url" class="checkout_input">
                </div>
                <div class="col-6 mb-2">
                    <label for="event_address">Event Location</label>
                    <input type="text" id="event_address" class="checkout_input">
                </div>
                <div class="col-6 mb-2">
                    <label for="event_start">Start Time</label>
                    <select name="event_start" id="event_start" class="checkout_input time ui-timepicker-input" >
                        <option value="700">7am</option>
                        <option value="800">8am</option>
                        <option value="900">9am</option>
                        <option value="1000">10am</option>
                        <option value="1100">11am</option>
                        <option value="1200">12pm</option>
                        <option value="1300">1pm</option>
                        <option value="1400">2pm</option>
                        <option value="1500">3pm</option>
                        <option value="1600">4pm</option>
                        <option value="1700">5pm</option>
                        <option value="1800">6pm</option>
                        <option value="1900">7pm</option>
                        <option value="2000">8pm</option>
                        <option value="2100">9pm</option>
                        <option value="2200">10pm</option>
                        <option value="2300">11pm</option>
                        <option value="0000">12am</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="event_end">End Time</label>
                    <select name="event_end" id="event_end" class="checkout_input time ui-timepicker-input">
                        <option value="700">7am</option>
                        <option value="800">8am</option>
                        <option value="900">9am</option>
                        <option value="1000">10am</option>
                        <option value="1100">11am</option>
                        <option value="1200">12pm</option>
                        <option value="1300">1pm</option>
                        <option value="1400">2pm</option>
                        <option value="1500">3pm</option>
                        <option value="1600">4pm</option>
                        <option value="1700">5pm</option>
                        <option value="1800">6pm</option>
                        <option value="1900">7pm</option>
                        <option value="2000">8pm</option>
                        <option value="2100">9pm</option>
                        <option value="2200">10pm</option>
                        <option value="2300">11pm</option>
                        <option value="0000">12am</option>
                    </select>
                </div>
                <div class="col-12 mt-5">
                    <button class="btn btn-outline btn-green w-100 font-weight-bold" id="btn-event">Create</button>
                </div>
            </div>
        </div>
    </div>
</section>