<?php
    include "../components/core.php";
    include "../components/header.php";

    
    $uid = $_SESSION['user']['id'];
    $users = $linki->query("SELECT * FROM `users` WHERE NOT `id` = '$uid'");
    $getChat = $linki->query("SELECT * FROM `user_chat`");
    $getMsg = $linki->query("SELECT * FROM `user_chat_msg`");
    $user = $users->fetch_assoc();
    // print_r($users); //для теста
    unset( $_SESSION['partnerName']);
   
?>



<div class="friend_list" style="font-size: 14pt; ">

    <?php foreach ($users as $key => $value):?>
        <hr>
        <div><?=$value['username']?> <a style="color: black;" href="chatroom.php?partnerName=<?=$value['username']?>">CHAT</a></div>
        <hr>
    <? endforeach;?>

</div>

<?php
loadComponent("footer");

?>