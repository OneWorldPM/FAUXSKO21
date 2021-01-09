<!DOCTYPE html>
<html lang="en">
<head>
    <title>Faux SKO 21</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?= base_url() ?>front_assets/images/FAUXSKO21/fauxsko_icon_transparent.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>front_assets/login_template/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>front_assets/login_template/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>front_assets/login_template/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>front_assets/login_template/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>front_assets/login_template/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>front_assets/login_template/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>front_assets/login_template/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>front_assets/login_template/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>front_assets/login_template/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>front_assets/login_template/css/main.css?v2">
    <!--===============================================================================================-->

    <style>
        #partitioned {
            padding-left: 15px;
            letter-spacing: 42px;
            border: 0;
            background-image: linear-gradient(to left, black 70%, rgba(255, 255, 255, 0) 0%);
            background-position: bottom;
            background-size: 50px 1px;
            background-repeat: repeat-x;
            background-position-x: 35px;
            width: 220px;
            min-width: 220px;
        }

        #divInner{
            left: 0;
            position: sticky;
        }

        #divOuter{
            width: 190px;
            overflow: hidden;
        }
    </style>
</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background-image: url(<?=base_url()?>front_assets/images/mohammed-shaheen-Fo44off83V8-unsplash.jpg)">
        <div class="wrap-login100">
            <div class="login100-form-title"">
					<img src="<?=base_url()?>front_assets/images/FAUXSKO21/SKO_2021_WebHero_1920w.png" style="width: 100%;height: auto;">
            </div>

            <form class="login100-form validate-form" method="post" action="<?= base_url() ?>login/authentication">
                <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                    <span class="label-input100">Username</span>
                    <input class="input100" type="text" id="email" name="email" placeholder="Enter username">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100" type="password" id="password" name="password" placeholder="Enter password">
                    <span class="focus-input100"></span>
                </div>

                <div class="flex-sb-m w-full p-b-30">
<!--                    <div class="contact100-form-checkbox">-->
<!--                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">-->
<!--                        <label class="label-checkbox100" for="ckb1">-->
<!--                            Remember me-->
<!--                        </label>-->
<!--                    </div>-->

                    <div>
                        <a href="#" class="txt1">
                            Forgot Password?
                        </a>
                    </div>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>
            </form>
        <a href="<?=base_url()?>">
            <button class="btn btn-secondary">
                Back
            </button>
        </a>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="otpModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="otpModalLabel">Untrusted Browser!</h5>
            </div>
            <div class="modal-body">
                <p>We don't recognize this browser, you need to use a One-Time-Password(OTP) to verify the login!</p>
                <p>We will send a One-Time-Password to your registered mobile number (<span id="masked_mobile_no"></span>)</p>
                <button class="send-otp-sms-btn btn btn-sm btn-info m-t-5"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send OTP</button>

                <div id="afterOtp" style="display: none">
                    <p style="color: green;">OTP was sent and is valid for next 5 minutes!</p>

                    <p style="margin-top: 30px;">Enter the OTP you received below</p>
                    <div id="divOuter">
                        <div id="divInner">
                            <input id="partitioned" type="text" maxlength="4" />
                        </div>
                    </div>

                    <div style="margin-top: 15px;">
                        <p>
                            <input type="checkbox" id="trust_browser_check"> Trust this browser!
                        </p>
                        <button class="verify-browser-btn btn btn-sm btn-success m-t-5"><i class="fa fa-check" aria-hidden="true"></i> Verify</button>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
            </div>
        </div>
    </div>
</div>

<!--===============================================================================================-->
<script src="<?=base_url()?>front_assets/login_template/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="<?=base_url()?>front_assets/login_template/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="<?=base_url()?>front_assets/login_template/vendor/bootstrap/js/popper.js"></script>
<script src="<?=base_url()?>front_assets/login_template/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?=base_url()?>front_assets/login_template/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="<?=base_url()?>front_assets/login_template/vendor/daterangepicker/moment.min.js"></script>
<script src="<?=base_url()?>front_assets/login_template/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="<?=base_url()?>front_assets/login_template/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>

<script src="<?=base_url()?>front_assets/login_template/js/main.js"></script>

<script>
    let base_url = "<?=base_url()?>";


</script>

</body>
</html>
