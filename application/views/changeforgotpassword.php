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
        .partitioned {
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

        <form id="reset-pass-from" class="login100-form validate-form">

            <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                <span class="label-input100">Password</span>
                <input class="input100" type="password" id="password" name="password" placeholder="Enter password">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-18" data-validate = "Password confirmation is required">
                <span class="label-input100">Confirm Password</span>
                <input class="input100" type="password" id="password2" name="password2" placeholder="Enter password">
                <span class="focus-input100"></span>
            </div>

            <div class="container-login100-form-btn">
                <button id="reset-pass" class="login100-form-btn" type="button">
                    Save
                </button>
            </div>
        </form>

        <a href="<?=base_url()?>/login">
            <button class="btn btn-secondary">
                Login
            </button>
        </a>

        <a href="/support/submit_ticket/displayForm" target="_blank" style="float: right;margin-right: 10px;">
            <span>
                <i class="far fa-life-ring"></i> SUPPORT
            </span>
        </a>
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

<script src="https://kit.fontawesome.com/fd91b3535c.js" crossorigin="anonymous"></script>

<script>
    let base_url = "<?=base_url()?>";

    let id = "<?=(isset($_GET['id']))?$_GET['id']:''?>";

    $(document).ready(function () {
        $("#reset-pass").on("click", function () {
            if ($("#password").val().trim() == "") {
                toastr.error("You need to enter a password");
                return false;
            } else if ($("#password2").val() == "") {
                toastr.error("You need to confirm your password");
                return false;
            } else if ($("#password").val() != $("#password2").val()) {
                toastr.error("Password and password confirmation does not match.");
                return false;
            }else if (id == '') {
                toastr.error("Invalid recovery link.");
                return false;
            } else {

                /* Send the data using post with element id name and name2*/
                var posting = $.post('<?= base_url() ?>forgotpassword/passwordChange', {
                    password: $("#password").val(),
                    cust_id: id
                });

                /* Alerts the results */
                posting.done(function(data) {
                    data = JSON.parse(data);

                    if (data.status == 'success')
                    {
                        Swal.fire(
                            'Done!',
                            "Your password is updated.",
                            'success'
                        ).then(()=>{
                            window.location.replace(base_url+'login');
                        });
                    }else
                    {
                        Swal.fire(
                            'Error!',
                            "Unable to change your password.",
                            'error'
                        );
                    }
                });
            }
            return false; //Prevent form to submitting
        });
    });

</script>

</body>
</html>
