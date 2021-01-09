
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
                }else if (data.status == 'new_browser')
                {
                    if (data.masked_reg_mobile == 'unset')
                    {
                        Swal.fire(
                            'Problem!',
                            'You have no or incorrect mobile number registered with us!',
                            'error'
                        );

                    }else{
                        $('.send-otp-sms-btn').attr('user_id', data.user_id);
                        $('.verify-browser-btn').attr('user_id', data.user_id);
                        $('#masked_mobile_no').text(data.masked_reg_mobile);
                        $('#otpModal').modal('show');
                    }

                }else if (data.status == 'failed')
                {
                    Swal.fire(
                        'Problem!',
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

    $('.send-otp-sms-btn').on('click', function () {

        $('.send-otp-sms-btn').prop("disabled", true);
        $('.send-otp-sms-btn').off('click');

        $.get( base_url+"login/sendLoginOtp/"+$(this).attr('user_id'), function(data) {
            data = JSON.parse(data);

            if (data.status == 'failed')
            {
                Swal.fire(
                    'Problem!',
                    data.msg,
                    'error'
                );
            }else{

                $('#afterOtp').show();
            }
        })
            .fail(function() {
                Swal.fire(
                    'Problem!',
                    "Unable to send the OTP, please try after some time!",
                    'error'
                );
            })
    });


    $('.verify-browser-btn').on('click', function () {

        let user_id = $(this).attr('user_id');
        let otp = $('#partitioned').val();
        let trust_check = ($('#trust_browser_check').is(":checked"))?'yes':'no';

        if (otp == '' || otp.length < 4)
        {
            toastr.error("You need to enter the 4 digit OTP!");
            return false;
        }

        $.post( base_url+"login/verifyOtp",
            {
                user_id: user_id,
                otp: otp,
                trust_check: trust_check
            })
            .done(function( data ) {
                data = JSON.parse(data);
                if (data.status == 'success'){

                    if (data.trusted_browser == 'true'){
                        Swal.fire(
                            'Verified!',
                            "This browser is verified and added to your trusted browsers list, we will redirect you to the home page in a moment!",
                            'success'
                        );
                    }else{
                        Swal.fire(
                            'Verified!',
                            "This browser is verified, we will redirect you to the home page in a moment!",
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



    var obj = document.getElementById('partitioned');
    obj.addEventListener('keydown', stopCarret);
    obj.addEventListener('keyup', stopCarret);

    function stopCarret() {
        if (obj.value.length > 3){
            setCaretPosition(obj, 3);
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
    

})(jQuery);
