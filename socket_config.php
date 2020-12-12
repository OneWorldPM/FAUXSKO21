<?php

/**
 * Never use same name for two different instances of the apps or two different apps
 * In Socket IO backend, I uses user id from php app to match many things
 * So user id might be same for different users on different apps
 *
 * -Athul AK
 */

$config = array(
    "socket_app_name" => "FAUXSKO21", //eg; cco_dev_athul
    "socket_lounge_room" => "FAUXSKO21_LOUNGE_GROUP", //eg; cco_lounge_group_dev_athul
    "socket_lounge_oto_chat_group" => "FAUXSKO21_LOUNGE_OTO", //eg; cco_lounge_oto_dev_athul
    "socket_active_user_list" => "FAUXSKO21_ACTIVE_USERS" //eg; cco_active_users_dev_athul
);

echo json_encode($config);
