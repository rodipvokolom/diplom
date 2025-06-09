<?php

include "../../components/core.php";

// echo $_SESSION['partnerName'];
$rid = $_SESSION['partnerName'];
$sid = $_SESSION['user']['id'];
$users = $linki->query("SELECT * FROM `users`");
$getChat = $linki->query("SELECT * FROM `user_chat`");
$getMsg = $linki->query("SELECT * FROM `user_chat_msg`");

$sender = $linki->query("SELECT * FROM `users` WHERE `id` = '$sid'");
$recipient = $linki->query("SELECT * FROM `users` WHERE `username` = '$rid'");

$uSend = $sender->fetch_assoc();
$uRecip = $recipient->fetch_assoc();
$us = $uSend['id'];
$ur = $uRecip['id'];
$msgSent = $_POST['msg_text'];

if(ctype_space($msgSent) || empty($msgSent)){
    redirect();
    $_SESSION['uchat']['error'] = "No empty or whitespace";
}else{

    $checkUC = $linki->query("SELECT * FROM `user_chat` WHERE `chat_owner` = '$us' AND `chat_partner` = '$ur'");
    if($checkUC->num_rows == 0){
    
        // echo 'no rows';
    
        $linki->query("INSERT INTO user_chat (chat_owner, chat_partner, last_action, created_at) VALUES 
                     ('{$uSend['id']}', '{$uRecip['id']}', UNIX_TIMESTAMP(), UNIX_TIMESTAMP())"); 
    
        $linki->query("INSERT INTO user_chat (chat_owner, chat_partner, last_action, created_at) VALUES 
                     ('{$uRecip['id']}', '{$uSend['id']}', UNIX_TIMESTAMP(), UNIX_TIMESTAMP())");
    };
    
    $myChatID = $linki->query("SELECT * FROM `user_chat` WHERE `chat_owner` = '$sid' AND `chat_partner` = '$ur'")->fetch_assoc();
    $partnerChatID = $linki->query("SELECT * FROM `user_chat` WHERE `chat_owner` = '$ur' AND `chat_partner` = '$sid'")->fetch_assoc();
    
    $linki->query("UPDATE `user_chat` SET last_action = UNIX_TIMESTAMP() WHERE `id` = '{$myChatID['id']}' OR `id` = '{$partnerChatID['id']}'");
    
    // echo $msgSent;
    
    
    $linki->query("INSERT INTO user_chat_msg (chat_id, msg_owner, sender, recip, date_sent, msg_status, msg_text) VALUES
    ('{$myChatID['id']}', '$us', '$us', '$ur', UNIX_TIMESTAMP(), 1, '$msgSent'),
    ('{$partnerChatID['id']}', '$ur', '$us', '$ur', UNIX_TIMESTAMP(), 0, '$msgSent');");
    redirect();

}



?>