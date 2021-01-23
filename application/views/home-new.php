<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= base_url() ?>front_assets/images/FAUXSKO21/fauxsko_icon_transparent.png">

    <title>Faux SKO 21</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>front_assets/login_template/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=base_url()?>front_assets/login_template/vendor/bootstrap/css/narrow-jumbotron.css" rel="stylesheet">
</head>

<style>
    @media (max-width: 750px) {
        .text-right {
            text-align: center !important;
        }

        .text-left {
            text-align: center !important;
        }
    }

    .home-menu-icon:hover{
        color: #55c7ff !important;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

        </ul>

        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="color: white;">
                    <i class="fas fa-envelope" style="font-size: 22px;" aria-hidden="true"></i> <span class="msg-noti-count badge badge-danger" style="display: none">0</span>
                </a>
                <div class="unread-msgs-list dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <div class="msg-divider dropdown-divider" style="display: none"></div>
                    <span class="msg-mark-all-read dropdown-item" style="cursor: pointer; display: none"><i class="fas fa-check-double" style="color: #2290df;"></i> Mark all as read</span>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="color: white;">
                    <?=($profile_data->profile == null)?'<i class="fas fa-user-circle"></i>':'<img src="'.base_url().'uploads/customer_profile/'.$profile_data->profile.'" alt="Avatar" style="border-radius: 50%;width: 25px;height: 26px;">'?> <?= $profile_data->first_name ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= base_url() ?>register/user_profile/<?= $profile_data->cust_id ?>"><i class="fas fa-user-edit"></i> Edit Profile</a>
<!--                    <a class="dropdown-item" href="--><?//= base_url() ?><!--home/notes"><i class="fas fa-briefcase"></i> My Briefcase</a>-->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= base_url() ?>login/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </li>
        </ul>

    </div>
</nav>

<body style="background-color: #002f70;">

<div class="container">
    <div class="jumbotron" style="background-color: #002f7000;padding-bottom: 0rem;padding-top: 0rem;">
        <img src="<?=base_url()?>front_assets/images/FAUXSKO21/FauxSKO_Featured_Image.png" style="width: 100%;height: auto;">
    </div>

<!--    <div class="row">-->
<!--        <div class="col-md-12">-->
<!--            <div style="padding:56.25% 0 0 0;">-->
<!--                <iframe src="https://player.vimeo.com/video/492170037?title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" ></iframe>-->
<!--            </div>-->
<!--            <script src="https://player.vimeo.com/api/player.js"></script>-->
<!--        </div>-->
<!--    </div>-->

    <div class="row text-center" style="margin-top: 30px;">

        <div class="col-md-4">
            <div style="border-radius: 25px;padding: 10px;margin-bottom: 10px;cursor: pointer;" onclick="location.href='<?= base_url() ?>sessions'">
                <i class="fas fa-chalkboard-teacher home-menu-icon" style="font-size: 95px !important; color: #009ce9;"></i>
                <div style="margin-top: 15px;color: white;font-size: 20px;">SESSIONS</div>
            </div>
        </div>

        <div class="col-md-4">
            <div style="border-radius: 25px;padding: 10px;margin-bottom: 10px;cursor: pointer;" onclick="location.href='<?= base_url() ?>lounge'">
                <i class="fas fa-couch home-menu-icon" style="font-size: 95px !important; color: #009ce9;"></i>
                <div style="margin-top: 15px;color: white;font-size: 20px;">LOUNGE</div>
            </div>
        </div>

        <div class="col-md-4">
            <div style="border-radius: 25px;padding: 10px;margin-bottom: 10px;cursor: pointer;" onclick="location.href='/support'">
                <i class="fas fa-cog home-menu-icon" style="font-size: 95px !important; color: #009ce9;"></i>
                <div style="margin-top: 15px;color: white;font-size: 20px;">SUPPORT</div>
            </div>
        </div>



<!--        <div class="col-md-4">-->
<!--            <div style="border: 1px solid white;border-radius: 25px;padding: 10px;margin-bottom: 10px;cursor: pointer;" onclick="location.href='base_url() ?>sponsor'">-->
<!--                <i class="fas fa-compress-arrows-alt" style="font-size: 125px !important; color: #009ce9;"></i>-->
<!--                <div style="margin-top: 15px;color: white;font-size: 25px;">TRAINING EXPO</div>-->
<!--            </div>-->
<!--        </div>-->

    </div>

<!--    <div class="row text-center">-->
<!---->
<!--        <div class="col-md-6 text-right">-->
<!--            <div class="text-center" style="border: 1px solid white;border-radius: 25px;padding: 10px;margin-bottom:5px;width: 175px;display: inline-block;cursor: pointer;">-->
<!--                <i class="fas fa-info-circle" style="font-size: 95px !important; color: #009ce9;"></i>-->
<!--                <div style="margin-top: 15px;color: white;font-size: 20px;">INFORMATION</div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="col-md-12">-->
<!--            <div class="text-center" style="border-radius: 25px;padding: 10px;margin-bottom:5px;width: 175px;display: inline-block;cursor: pointer;" onclick="location.href='/support'">-->
<!--                <i class="fas fa-cog" style="font-size: 95px !important; color: #009ce9;"></i>-->
<!--                <div style="margin-top: 15px;color: white;font-size: 20px;">SUPPORT</div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    </div>-->

</div> <!-- /container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script defer src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

<script src="<?=base_url()?>front_assets/login_template/vendor/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
<script src="https://kit.fontawesome.com/fd91b3535c.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js" integrity="sha512-v8ng/uGxkge3d1IJuEo6dJP8JViyvms0cly9pnbfRxT6/31c3dRWxIiwGnMSWwZjHKOuY3EVmijs7k1jz/9bLA==" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</body>

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
                    '<a class="msg-item dropdown-item" href="lounge"><strong>No new messages</strong></a>');
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
                        '<a class="msg-item dropdown-item" href="lounge"><strong>'+message.from_name+' </strong><i class="fas fa-angle-right"></i> '+messageText+'</a>');
                }


            });
        });
    }

    function markAllAsRead() {
        $.get("<?= base_url() ?>user/UnreadMessages/markAllInAsRead/", function() {
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
</script>

</html>
