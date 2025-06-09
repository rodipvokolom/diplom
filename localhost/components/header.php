<?php
    // if(isset($_SESSION['user'])){
    //     if(isset($_SESSION['sentFrom'])){

    //         echo "Sender:".$_SESSION['sentFrom'];
    //     }
    //     echo " || UID:".$_SESSION['user']['id'];
    //     echo " || USERNAME:".$_SESSION['user']['username'];
    //     $huid = $_SESSION['user']['id'];
        // $head_users = $linki->query("SELECT * FROM `users` WHERE `id` = '$huid'");
        // $head_user = $head_users->fetch_assoc();
    // }

    
    if($config->thisPage == 'globalChatTerminal'){
        $inner_setion = 'alt__inner-section';
    }elseif($config->thisPage == 'REDIRECTION...'){
    }else{
        $inner_setion = 'inner-section';
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$config->pageName?></title>
    <link rel="stylesheet" href="../assets/styles/style.css">
    <link rel="stylesheet" href="../assets/styles/ach.css">
    <link rel="stylesheet" href="../assets/styles/profile.css">
    <link rel="stylesheet" href="../assets/styles/users.css">
    <link rel="stylesheet" href="../assets/styles/tickets.css">
    <link rel="stylesheet" href="../assets/styles/chatStyle.css">
    <link rel="stylesheet" href="../assets/styles/contextMenu.css">
    <?php if($config->thisPage == "globalChatTerminal"):?>
    <link rel="stylesheet" href="../assets/styles/altChat.css">
    <?endif;?>
    <link rel="stylesheet" href="../assets/styles/index.css">
    <link rel="stylesheet" href="../assets/styles/ff.css">
</head>
<body>
    

<main>

<section class="header__main">
    <div class="header__main__wrapper">
        <div class="sidebar__btn">
            <button id="toggle__sidebar"><img id="sideb_img" id="side_menu" src="../assets/img/misc/menu.png" alt=""></button>
        </div>
        <div class="tittle__space">
            <h2 style="text-decoration: underline;"><?=$config->pageName;?></h2>
        </div>
        <div class="user__info__area">

        </div>
    </div>
</section>

<section class="<?=$inner_setion;?>">

    <div id="sect__selector" class="inner__sect__header">
        <div class="header__wrapper">
            <div class="header__element <?=is_active('index');?>">
                
                <a <?=hrefR('index');?>><img src="../assets/img/misc/s_home.png" alt=":(">Главная</a>
            </div>
            <div class="header__element <?=is_active('ticketsPage');?>" >
                <a <?=hrefR('tickets');?>><img src="../assets/img/misc/s_ticket.png" alt=":(">Тикеты</a>
            </div>
            <div class="header__element <?=is_active('usersPage');?>">
                <a <?=hrefR('users');?>><img src="../assets/img/misc/s_users.png" alt=":(">Пользователи</a>
            </div>

        <?php if(isset($_SESSION['user']['id'])):?>
            <div class="header__element <?=is_active('globalChat');?>">
                <a <?=hrefR('chat');?>><img src="../assets/img/misc/s_chat.png" alt=":(">Общение</a>
            </div>
            <div class="header__element <?=is_active('profilePage');?>">
                <a <?=hrefR('user/profile');?>><img src="../assets/img/misc/s_profile.png" alt=":(">Профиль</a>
            </div>

            
            <!-- <div class="header__user__show">
                <div class="header__user__show__wrapper">
                    <div class="header__user__pfp"><img src="../assets/img/placeholder.png" alt=""></div>
                    <div class="header__user__username"><p></div>
                </div>
            </div> -->
            
            <div class="header__element <?=is_active('user/quit');?>" id="quit__btn">
                <a <?=hrefR('actions/user/quit');?>><img src="../assets/img/misc/s_quit.png" alt=":(">Выйти</a>
            </div>

            
        <?else:?>
            <div class="header__element <?=is_active('authPage');?>">
                <a <?=hrefR('authPage');?>><img src="../assets/img/misc/s_log.png" alt=":(">Авторизация</a>
            </div>
        <?endif;?>
        </div>
    </div>

