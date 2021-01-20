
(function ($) {
    "use strict";

    toastr.options = {
        "debug": false,
        "closeButton": true,
        "positionClass": "toast-bottom-right",
        "onclick": null,
        "fadeIn": 300,
        "fadeOut": 1000,
        "timeOut": 5000,
        "extendedTimeOut": 1000
    };

    /*==================================================================
    [ Focus Contact2 ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })

    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(e){
        e.preventDefault();

        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        if (check)
        {
            /* get the action attribute from the <form action=""> element */
            var $form = $(this),
                url = $form.attr('action');

            /* Send the data using post with element id name and name2*/
            var posting = $.post(url, {
                email: $('#email').val(),
                password: $('#password').val()
            });

            /* Alerts the results */
            posting.done(function(data) {
                data = JSON.parse(data);

                if (data.status == 'success')
                {
                    window.location.replace(base_url+'home');
                }else if (data.status == 'default_password')
                {
                    $('#reset-pass-btn').attr('user-id', data.user_id);
                    $('#reset-pass-btn').attr('token', data.token);
                    $('#passResetModal').modal('show');

                }else if (data.status == 'new_browser')
                {
                    if (data.masked_reg_mobile == 'unset')
                    {
                        $('.send-otp-sms-btn').attr('user_id', data.user_id);
                        $('.send-otp-email-btn').attr('user_id', data.user_id);

                        $('.verify-browser-btn').attr('user_id', data.user_id);

                        $('#masked_email').text(data.masked_reg_email);

                        $('#addMobileModal').modal('show');

                    }else{
                        $('.send-otp-sms-btn').attr('user_id', data.user_id);
                        $('.send-otp-email-btn').attr('user_id', data.user_id);

                        $('.verify-browser-btn').attr('user_id', data.user_id);

                        $('#masked_mobile_no').text(data.masked_reg_mobile);
                        $('#masked_email').text(data.masked_reg_email);

                        $('#otpModal').modal('show');
                    }

                }else if (data.status == 'failed')
                {
                    Swal.fire(
                        data.title,
                        data.msg,
                        'error'
                    );
                }

            });
            posting.fail(function(data) {
                alert(data);
            });
        }
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }

    $('.send-otp-sms-btn, .send-otp-email-btn').on('click', function () {

        if ($(this).prop('disabled') == true)
        {
            return false;
        }

        let otpType = $(this).attr('otp-type');

        let mobile_country_code = null;
        let mobile_no = null;
        let action = null;
        let user_id = $(this).attr('user_id');

        if ($(this).attr('action') == 'add-mobile')
        {
            let action = 'add-mobile';

            let mobile_country_code = $('#countryCode').val();
            let mobile_no = $('#mobile_no').val();

            if (mobile_no == '')
            {
                toastr.error("You need to enter your phone number.");
                return false;
            }

            if (mobile_no.length < 9)
            {
                toastr.error("Phone number should be at least 9 digits.");
                return false;
            }
        }


        $('.send-otp-sms-btn').prop("disabled", true);

        $.post( base_url+"login/sendLoginOtp/"+user_id+"/"+otpType,
            {
                mobile_country_code: $('#countryCode').val(),
                mobile_no: $('#mobile_no').val()
            })
            .done(function( data ) {
                data = JSON.parse(data);

                if (data.status == 'failed')
                {
                    Swal.fire(
                        'Problem!',
                        data.msg,
                        'error'
                    );

                    $('.send-otp-sms-btn').prop("disabled", false);
                }else{

                    if (data.addPhone == true)
                    {
                        $('#afterOtpAddMob').show();
                    }else{
                        $('.spam-warning').show();
                        $('#afterOtp').show();
                    }
                }
            })
            .fail(function() {
                Swal.fire(
                    'Problem!',
                    "Unable to send the OTP, please try after some time.",
                    'error'
                );
            })
    });


    $('.verify-browser-btn').on('click', function () {

        let user_id = $(this).attr('user_id');

        let otp = ($(this).attr('action') == 'add-mobile')?$('#addMobileOtpInput').val():$('#otpInput').val();

        let addPhone = ($(this).attr('action') == 'add-mobile')?'+'+$('#countryCode').val()+$('#mobile_no').val():'';

        let trust_check = ($(this).attr('action') == 'add-mobile')?($('#trust_browser_check1').is(":checked"))?'yes':'no':($('#trust_browser_check2').is(":checked"))?'yes':'no';

        console.log(otp);
        if (otp == '' || otp.length < 4)
        {
            toastr.error("You need to enter the 4 digit OTP.");
            return false;
        }

        $.post( base_url+"login/verifyOtp",
            {
                user_id: user_id,
                otp: otp,
                trust_check: trust_check,
                addPhone: addPhone
            })
            .done(function( data ) {
                data = JSON.parse(data);
                if (data.status == 'success'){

                    if (data.trusted_browser == 'true'){
                        Swal.fire(
                            'Verified!',
                            "This browser is verified and added to your trusted browsers list, we will redirect you to the home page in a moment.",
                            'success'
                        );
                    }else{
                        Swal.fire(
                            'Verified!',
                            "This browser is verified, we will redirect you to the home page in a moment.",
                            'success'
                        );
                    }

                    setTimeout(function () {
                        window.location.replace(base_url+'home');
                    }, 4000);

                }else{
                    Swal.fire(
                        'Problem!',
                        data.msg,
                        'error'
                    );
                }
            });
    });


    $('.other-opt-btn').on('click', function () {
        $('#mob-for-otp-txt').toggle();
        $('#otp-sms-btn').toggle();
        $('#email-for-otp-txt').toggle();
        $('#otp-email-btn').toggle();
    });


    $('.email-otp-modal-btn').on('click', function () {
        $('#addMobileModal').modal('hide');

        $('#mob-for-otp-txt').hide();
        $('#otp-sms-btn').hide();

        $('.other-opt-btn').hide();

        $('#email-for-otp-txt').show();
        $('#otp-email-btn').show();


        $('#otpModal').modal('show');
    });



    var otp1 = document.getElementById('otpInput');
    var otp2 = document.getElementById('addMobileOtpInput');
    otp1.addEventListener('keydown', stopCarret1);
    otp1.addEventListener('keyup', stopCarret1);
    otp2.addEventListener('keydown', stopCarret2);
    otp2.addEventListener('keyup', stopCarret2);

    function stopCarret1() {
        if (otp1.value.length > 3){
            setCaretPosition(otp1, 3);
        }
    }

    function stopCarret2() {
        if (otp2.value.length > 3){
            setCaretPosition(otp2, 3);
        }
    }

    function setCaretPosition(elem, caretPos) {
        if(elem != null) {
            if(elem.createTextRange) {
                var range = elem.createTextRange();
                range.move('character', caretPos);
                range.select();
            }
            else {
                if(elem.selectionStart) {
                    elem.focus();
                    elem.setSelectionRange(caretPos, caretPos);
                }
                else
                    elem.focus();
            }
        }
    }


    $('#reset-pass-btn').on('click', function () {
        let password = $('#resetPassword1').val();
        let cnfmPassword = $('#resetPassword2').val();
        let user_id = $(this).attr('user-id');
        let token = $(this).attr('token');

        if (password == '' || cnfmPassword == '')
        {
            toastr.error("You need to enter both password and confirm password.");
            return false;
        }

        if (password != cnfmPassword)
        {
            toastr.error("Password and confirm password does not match.");
            return false;
        }

        $.post( base_url+"login/resetPass",
            {
                user_id: user_id,
                password: password,
                token: token
            })
            .done(function( data ) {
                data = JSON.parse(data);
                if (data.status == 'success'){
                    $('#passResetModal').modal('hide');
                    Swal.fire(
                        'Done!',
                        "Your password has been reset, you can now login using new credentials.",
                        'success'
                    );
                }else{
                    Swal.fire(
                        'Problem!',
                        "Unable to reset the password",
                        'error'
                    );
                }
            });

    })

    $('#forgot-pass-btn').on('click', function () {
        $('#forgotPassModal').modal('show');
    });

    $('#pass-rec-email-btn').on('click', function () {
        let email = $('#pass-rec-email').val();

        if(email.trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {

            toastr.error("You need to enter a valid email address");
            return false;
        }


        $.ajax({
            url: base_url+"forgotpassword/sendEmail",
            type: "post",
            data: {'email': email},
            dataType: "json",
            success: function (data, textStatus, jqXHR) {
                if (data.status == 'success') {
                    Swal.fire(
                        'Done!',
                        data.msg,
                        'success'
                    );
                }else {
                    Swal.fire(
                        'Error!',
                        data.msg,
                        'error'
                    );
                }
            }
        });

    });



    $('#login-btn').prop('disabled', false);
    

})(jQuery);
