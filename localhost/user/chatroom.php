<?php
    include "../components/core.php";
    if(!isset($_SESSION['user'])){redirect();};
    $users = $linki->query("SELECT * FROM `users`");

    $getUN = $_GET['partnerName'];
    $uid = $_SESSION['user']['id'];
    $_SESSION['partnerName'] = $getUN;
    
    $getUserByName = $linki->query("SELECT * FROM `users` WHERE `username` = '$getUN'");
    $getUser = $getUserByName->fetch_assoc();
    $gttt = $getUser['id'];
    $gpps = $linki->query("SELECT * FROM `profile` WHERE `user_id` = '$gttt'");
    $gppss = $gpps->fetch_assoc();

    $getChat = $linki->query("SELECT * FROM `user_chat` WHERE `chat_owner` = '$uid' AND `chat_partner` = '{$getUser['id']}'");
    $gc = $getChat->fetch_assoc();
    $gcp = $gc['chat_partner'];
    
    $getMsg  = $linki->query("SELECT * FROM `user_chat_msg` WHERE `chat_id` = '{$gc['id']}'");
    $gm = $getMsg->fetch_assoc();

    $test = $linki->query("SELECT `users`.*, `user_chat_msg`.*
        FROM `user_chat_msg` 
        LEFT JOIN `users` ON `user_chat_msg`.`sender` = `users`.`id` WHERE `chat_id` = '{$gc['id']}'");

    $getPartnerUser = $linki->query("SELECT * FROM `users` WHERE `id` = '$gcp'");
    $gpc = $getPartnerUser->fetch_assoc();
    $getPartnerProf = $linki->query("SELECT * FROM `profile` WHERE `user_id` = '$gcp'");
    $gpp = $getPartnerProf->fetch_assoc();

    $config->pageName = "Чат с ".$getUser['username'];
    $config->thisPage = "globalChat";
    loadComponent("header");

?>
<div class="chatroom__main">
<a href="../users.php" id="users__back">< Вернуться</a>

    <div class="chat__user__info">
        <div class="chat__user__pfp"><img src="../assets/img/user_pfp/<?=$gppss['pic']?>" alt=""></div>
        <div class="chat__user__nickname">
            <a href="../user/profile_see.php?watchUser=<?=$getUser['id']?>">
                <?=$getUser['username']?>
            </a>
        </div>
    </div>
    <div class="input__field__msg"">
        <form action="../actions/user/chat_process.php" method="POST">
            <input type="text" placeholder="Текст сообщения..." name="msg_text" id="chat_msg_field">
            <input type="submit" name="sub__msg" value="Отправить" id="">
        </form>
    </div>

    <div class="users__msg">
        <div class="msg__body">

        <?php foreach ($test as $key => $value):?>

                <div class="message__card">
                    <p id="pm_un"><?=$value['username']." ".'('.date("Y d M \ H:i:s", $value['date_sent'])."):"?></p>
                    <p id="pm_msg"><?=">".$value['msg_text']?></p>
                </div>

        
        <? endforeach;?>
        </div>

    </div>


</div>

<?php
loadComponent("footer");
?>