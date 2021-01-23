<div class="modal fade" id="push_notification" tabindex="-1" role="modal" aria-labelledby="modal-label" aria-hidden="true" style="display: none; text-align: left; right: unset;">
    <input type="hidden" id="push_notification_id" value="">
    <div class="modal-dialog">
        <div class="modal-content" style="border: 1px solid #679B41;">
            <div class="modal-body">
                <div class="row" style="padding-top: 10px; padding-bottom: 20px;">
                    <div class="col-sm-12">
                        <div style="color:#000000; font-size: 16px; font-weight: 800; " id="push_notification_message"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="close push_notification_close" style="padding: 10px; color: #fff; background-color: #363535; opacity: 1; font-size: 18px; font-weight: 400;" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- END: WRAPPER -->
<!-- GO TOP BUTTON -->
<a class="gototop gototop-button" href="#"><i class="fa fa-chevron-up"></i></a>

<!-- Theme Base, Components and Settings -->
<script src="<?= base_url() ?>front_assets/js/theme-functions.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>

<script src="https://kit.fontawesome.com/fd91b3535c.js" crossorigin="anonymous"></script>

<!-- Custom js file -->
<script src="<?= base_url() ?>front_assets/js/custom.js?v=3"></script>
<script src="<?= base_url() ?>assets/alertify/alertify.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js" integrity="sha512-v8ng/uGxkge3d1IJuEo6dJP8JViyvms0cly9pnbfRxT6/31c3dRWxIiwGnMSWwZjHKOuY3EVmijs7k1jz/9bLA==" crossorigin="anonymous"></script>

<script>
    var user_id = <?= $this->session->userdata("cid") ?>;
    var user_name = "<?= $this->session->userdata('fullname') ?>";
    function extract(variable) {
        for (var key in variable) {
            window[key] = variable[key];
        }
    }

    $(function() {

        $.get( "<?=base_url()?>socket_config.php", function( data ) {
            var config = JSON.parse(data);
            extract(config);

            var socketServer = "https://socket.yourconference.live:443";
            let socket = io(socketServer);
            socket.on('serverStatus', function (data) {
                socket.emit('addMeToActiveListPerApp', {'user_id':user_id, 'app': socket_app_name, 'room': socket_active_user_list});
            });

            setTimeout(function(){ //Adding to active users list 5 seconds after load - delay countermeasure
                socket.emit('userActiveChangeInApp', {"app":socket_app_name, "room":socket_active_user_list, "name":user_name, "userId":user_id, "status":true});
            }, 3000);

            // Active again
            function resetActive(){
                socket.emit('userActiveChangeInApp', {"app":socket_app_name, "room":socket_active_user_list, "name":user_name, "userId":user_id, "status":true});
            }
            // No activity let everyone know
            function inActive(){
                socket.emit('userActiveChangeInApp', {"app":socket_app_name, "room":socket_active_user_list, "name":user_name, "userId":user_id, "status":false});
            }

            $(window).on("blur focus", function(e) {
                var prevType = $(this).data("prevType");

                if (prevType != e.type) {   //  reduce double fire issues
                    switch (e.type) {
                        case "blur":
                            inActive();
                            break;
                        case "focus":
                            resetActive();
                            break;
                    }
                }

                $(this).data("prevType", e.type);
            });

            socket.on('unreadMessage', function (data) {
                if(data.chat_to == user_id)
                    fillUnreadMessages();
            });

            var app_name_main = "<?=getAppName("") ?>";
            push_notification_admin();
            //setInterval(push_notification_admin, 2000);
            socket.on('push_notification_change', (socket_app_name) => {
                if (socket_app_name == app_name_main)
                    push_notification_admin();
            });
        });

        fillUnreadMessages();

        $('.msg-mark-all-read').on('click', function () {
            markAllAsRead();
        });



        /************ Auto redirect to next zoom meeting ***************/
        $.ajax({
            url: "<?= base_url() ?>sessions/getImmediateMeeting",
            type: "post",
            dataType: "json",
            success: function (data) {

                if (data.session.zoom_redirect == 1)
                {
                    var zoom_meet_rem_seconds = data.remaining_seconds;

                    if (data.remaining_seconds <= 0) {
                        Swal.fire(
                            data.session.session_title,
                            'You will be redirected the Zoom meeting in 60 seconds <br>' +
                            '<a href="'+data.session.zoom_redirect_url+'" target="_blank">Please click here to go there now.</a>',
                            'info'
                        );
                        setTimeout(function () {
                            window.open(data.session.zoom_redirect_url, "_blank") || window.location.replace(data.session.zoom_redirect_url);
                        }, 60000);

                    } else if(data.remaining_seconds <= 60) {
                        Swal.fire(
                            data.session.session_title,
                            'You will be redirected the Zoom meeting in 60 seconds <br>' +
                            '<a href="'+data.session.zoom_redirect_url+'" target="_blank">Please click here to go there now.</a>',
                            'info'
                        );
                        setTimeout(function () {
                            window.open(data.session.zoom_redirect_url, "_blank") || window.location.replace(data.session.zoom_redirect_url);
                        }, 60000);

                    }else {
                        setInterval(function () {

                            if (data.remaining_seconds == 60) {
                                Swal.fire(
                                    data.session.session_title,
                                    'You will be redirected the Zoom meeting in 60 seconds <br>' +
                                    '<a href="'+data.session.zoom_redirect_url+'" target="_blank">Please click here to go there now.</a>',
                                    'info'
                                );
                            }

                            if (data.remaining_seconds <= 0) {

                                window.open(data.session.zoom_redirect_url, "_blank") || window.location.replace(data.session.zoom_redirect_url);

                            } else {
                                data.remaining_seconds--;
                            }
                        }, 1000);
                    }
                }
            }
        });
        /************ End of auto redirect to next zoom meeting ***************/

    });

    function fillUnreadMessages() {
        $('.msg-item').remove();
        $.get("<?= base_url() ?>user/UnreadMessages/getUnreadMessages", function (messages) {
            messages = JSON.parse(messages);
            var count = Object.keys(messages).length;
            if (count > 0) {
                $('.msg-noti-count').text(count);
                $('.msg-noti-count').show();
                $('.msg-divider').show();
                $('.msg-mark-all-read').show();
            }
            else {
                $('.unread-msgs-list').prepend('' +
                    '<li class="msg-item"><a href="lounge" style="color: black">No new messages</a></li>');
                $('.msg-noti-count').hide();
                $('.msg-divider').hide();
                $('.msg-mark-all-read').hide();
            }

            $.each(messages, function (number, message) {

                let messageText = (message.text.length > 32)?message.text.substring(0,32)+'...':message.text;

                if (message.from_room_type == 'sponsor'){
                    $('.unread-msgs-list').append('' +
                        '<a target="_blank" class="dropdown-item waves-effect waves-light m-b-20" href="<?= base_url() ?>sponsor/view/' + message.sponsor_id + '"><i class="fa fa-commenting-o" aria-hidden="true"></i><strong>New message from ' + message.company_name + '</strong></a>');
                    //$('.unread-msgs-list').append('' +
                    //    '<a target="_blank" class="dropdown-item waves-effect waves-light" href="<?//= base_url() ?>//sponsor/view/' + message.sponsor_id + '"><strong>New message from ' + message.company_name + '</strong></a>' +
                    //    '<a href="<?//= base_url() ?>//sponsor/view/' + message.sponsor_id + '" target="_blank">' + message.text + '</a>');
                }else{
                    $('.unread-msgs-list').prepend('' +
                        '<li class="msg-item"><a href="lounge" style="color: black"><strong>'+message.from_name+'</strong> <i class="fas fa-angle-right"></i> '+messageText+'</a></li>');
                }


            });
        });
    }

    function markAllAsRead() {
        $.get( base_url+"user/UnreadMessages/markAllInAsRead/", function() {
            fillUnreadMessages();
        });
    }

    function push_notification_admin()
    {
        var push_notification_id = $("#push_notification_id").val();

        $.ajax({
            url: "<?= base_url() ?>push_notification/get_push_notification_admin",
            type: "post",
            dataType: "json",
            success: function (data) {
                if (data.status == "success") {
                    if (push_notification_id == "0") {
                        $("#push_notification_id").val(data.result.push_notification_id);
                    }
                    if (push_notification_id != data.result.push_notification_id) {
                        $("#push_notification_id").val(data.result.push_notification_id);
                        $('#push_notification').modal('show');
                        $("#push_notification_message").text(data.result.message);
                    }
                } else {
                    $('#push_notification').modal('hide');
                }
            }
        });
    }

    function getParameters() {
        var searchString = window.location.search.substring(1),
            params = searchString.split("&"),
            hash = {};

        if (searchString == "") return {};
        for (var i = 0; i < params.length; i++) {
            var val = params[i].split("=");
            hash[unescape(val[0])] = unescape(val[1]);
        }

        return hash;
    }


</script>

</body>
</html>
