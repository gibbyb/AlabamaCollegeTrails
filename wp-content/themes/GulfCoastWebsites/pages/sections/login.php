<?php

/* 
 * licensed under the GPL.
 */
require_once __DIR__.'/../../config.php';
?>
<section id="login" class="d-none">
    <div class="overlay-dark active">
    </div>
    <div class="mx-auto my-auto bg-white border-block center-horizontal center-vertical login-box bg-grey" style="max-width:500px;max-height: 500px;">
        <div class="col-12 d-flex justify-content-end me-5 login-container">
            <i class="bi bi-x fa-2x me-3" id="login-close"></i>
        </div>
        <div class="container p-5 pt-0">
            <div class="row">
                <div class="col-12 text-center mb-2">
                    <h4 class="border-highlight">Login</h4>
                </div>
                <div id="result" class="mb-2 error">
                </div>
                <div class="col-12 mb-2">
                    <label for="login_email">Email Address*</label>
                    <input type="email" id="login_email" class="checkout_input"  value="<?php if(isset($_SESSION['customer']['email']))print($_SESSION['customer']['email']); ?>">
                </div>
                <div class="col-12">
                    <!-- Password -->
                    <label for="login_password">Password*</label>
                    <input type="password" id="login_password" class="checkout_input" >
                </div>
                <div class="order_terms mb-2">By continuing you agree to our <a target="_blank" href="../terms/">Terms and conditions</a>.</div>
                <div class="col-12 mt-3">
                    <button class="btn btn-orange w-100 btn-outline" id="btn-login">Login</button>
                </div>
                <div class="col-12 d-flex mt-3 mb-5 justify-content-between">
                    <a href="" id="forgot">Forgot password</a>
                    <a href="" id="forgot">Register (disabled)</a>
                </div>
            </div>
        </div>
    </div>
</section>
