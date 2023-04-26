<div class="welcome-section">
    <img class="card-img-top" src="img/hikers-on-trail.jpg" alt="Happy Hikers on a Trail" class="">
    <h1>Welcome to Alabama College Trails!</h1>
</div>
<script src="js/weather.js"></script>
<div class="about-us-section">
    <h2>About Us</h2>
    <p class="centered">Alabama College Trails is a club for outdoor enthusiasts who love to explore the beautiful trails of Alabama. Our members come from all walks of life and all levels of experience, but we share a common love for hiking and the great outdoors. Whether you're a seasoned hiker or just starting out, we welcome you to join us on our adventures!</p>
</div>
<section class="featured-hikes mb-5"><!-- updated for mobile and desktop scaling -->
    <div class="container">
        <h1 class="col-12 h1 centered">Featured Hikes</h1>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <div class="col">
                <div class="card h-100">
                    <img class="card-img-top" src="img/Kings_Chair.jpg" alt="King's Chair">
                    <img class="card-img-bottom" src="img/kingschairmap.png" alt="King's Chair Map">                <div class="card-body">
                    <h5 class="card-title">King's Chair</h5>
                    <p class="card-text" id = "kingsChair-city">Pelham</p>
                    <p class="card-text" id="kingsChair-temperature">Loading temperature...</p>
                    <p class="card-text" id="kingsChair-rain">Loading chance of rain...</p>
                    <p class="card-text">Come and conquer King's Chair, one of the most rewarding hiking trails in Cape Breton Highlands National Park. With its breathtaking panoramic view of the Gulf of St. Lawrence, it's the perfect challenge for adventurous hikers seeking an unforgettable experience</p>
                </div>
              </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img class="card-img-top" src="img/Alum_Hollow.jpg" alt="Alum Hollow">
                    <img class="card-img-bottom" src="img/Alum_Hollow_Map.png" alt="Alum Hollow Map">
                    <div class="card-body">
                        <h5 class="card-title">Alum Hollow</h5>
                        <p class="card-text" id = "alumHollow-city">Burrows</p>
                        <p class="card-text" id="alumHollow-temperature">Loading temperature...</p>
                        <p class="card-text" id="alumHollow-rain">Loading chance of rain...</p>
                        <p class="card-text">Alum Hollow Trail is a scenic hiking trail located in Alabama that offers stunning views of waterfalls, rock formations, and wildlife. With a moderate difficulty level, it is perfect for hikers of all skill levels looking for a day hike in the great outdoors.</p>
                    </div>
              </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img class="card-img-top" src="img/Little_River.jpg" alt="Little River Canyon">
                    <img class="card-img-bottom" src="img/Little_River_Map.png" alt="Little River Canyon Map">
                    <div class="card-body">
                        <h5 class="card-title">Little River Canyon</h5>
                        <p class="card-text" id = "littleRiver-city">Fort Payne</p>
                        <p class="card-text" id="littleRiver-temperature">Loading temperature...</p>
                        <p class="card-text" id="littleRiver-rain">Loading chance of rain...</p>
                        <p class="card-text">Little River Canyon Trail is a beautiful hiking trail in Alabama that follows the scenic Little River and offers stunning views of waterfalls, cliffs, and forests. With a moderate difficulty level and a length of just under 3 miles, it is perfect for a day hike or a weekend camping trip.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img class="card-img-top" src="img/Stone_Cuts.jpg" alt="Stone Cuts Trail">
                    <img class="card-img-bottom" src="img/Stone_Cuts_Map.png" alt="Stone Cuts Trail Map">
                    <div class="card-body">
                        <h5 class="card-title">Stone Cuts Trail</h5>
                        <p class="card-text" id = "stoneCuts-city">Brownsboro</p>
                        <p class="card-text" id="stoneCuts-temperature">Loading temperature...</p>
                        <p class="card-text" id="stoneCuts-rain">Loading chance of rain...</p>
                        <p class="card-text">Stone Cuts Trail is a challenging hiking trail located in Alabama that offers a unique and challenging hiking experience through steep terrain, rocky outcroppings, and stunning vistas. With a length of just over 2 miles, it is perfect for experienced hikers looking for a challenging and rewarding hike in the great outdoors.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="newsletter-section">
    <h2>Subscribe to Our Newsletter</h2>
    <form>
        <label for="email">Enter your email address:</label>
        <input type="email" id="email-subscribe" name="email" required>
        <button id="subscribe" type="submit">Subscribe</button><!-- functionality in header.js (bottom area) -->
    </form>
    <div class="mt-3 mx-auto" id="newsletter" style="max-width: 75vw;height:auto;"></div>
</div>