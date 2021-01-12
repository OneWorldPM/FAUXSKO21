
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

        if (isCaptchaChecked() == false)
        {
            $('#errorcaptcha').show();
            check=false;
        }


        console.log('form check status:'+ check);

        if (check)
        {
            document.getElementById('regForm').submit();
        }
        return check;
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

        $.post( base_url+"login/sendLoginOtp/"+$(this).attr('user_id')+"/"+otpType,
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

    

})(jQuery);

function isCaptchaChecked() {
    return grecaptcha && grecaptcha.getResponse().length !== 0;
}

function recaptchaCallback() {
    $('#errorcaptcha').hide();
}
