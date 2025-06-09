<?php
    include 'components/core.php';
    $config->pageName = "Пользователи сайта";
    $config->thisPage = "usersPage";
    $uid = $_SESSION['user']['id'];


    $users = $linki->query("SELECT * FROM `users`");
    $profiles = $linki->query("SELECT * FROM `profile`");

    $usersProfAll = $linki->query("SELECT `profile`.*, `users`.* 
                                FROM `profile` 
                                LEFT JOIN `users` ON `profile`.`user_id` = `users`.`id` ORDER BY `username` ASC");
    $usersMod = $linki->query("SELECT `profile`.*, `users`.* 
                                FROM `profile` 
                                LEFT JOIN `users` ON `profile`.`user_id` = `users`.`id` WHERE `role` != 'observer' ORDER BY `username` ASC");
    loadComponent('header');

?>

<div class="users__main">

    <div class="users__wrapper">


        <div class="users__sect moderation">
            <div class="users__group"><p>Модерация:</p></div>
            <div class="users__list">
                
                <?php foreach ($usersMod as $key => $value):?>

                <div class="users__card">
                    <div class="users__card__wrapper">
                        <div class="users__card__logo">
                            <div class="users__pic"><img src="assets/img/user_pfp/<?=$value['pic']?>" alt=":("></div>
                            <div class="users__role"><?=$value['role']?></div>
                            <div class="users__nickname"><?=$value['username']?></div>
                            <div class="users__panel">
                                <a href="../user/chatroom.php?partnerName=<?=$value['username']?>"><img src="../assets/img/misc/write.png" alt="chat"></a>
                                <a href="user/profile_see.php?watchUser=<?=$value['id']?>"><img src="../assets/img/misc/eye.png" alt="prof"></a>
                                <a href="#"><img src="../assets/img/misc/report.png" alt="repo"></a>
                            </div>
                        </div>
                        <div class="users__card__info">
                            <div class="users__status">
                                <p>Статус: <?=$value['c_status']?></p>
                            </div>

                        </div>
                    </div>
                </div>

                <?endforeach;?>

            </div>
        </div>


        <div class="users__sect allusers">
        <div class="users__group"><p>Пользователи:</p></div>
            <div class="users__list">
                
                <?php foreach ($usersProfAll as $key => $value):?>

                <div class="users__card">
                    <div class="users__card__wrapper">
                        <div class="users__card__logo">
                            <div class="users__pic"><img src="assets/img/user_pfp/<?=$value['pic']?>" alt=":("></div>
                            <div class="users__role"><?=$value['role']?></div>
                            <div class="users__nickname"><?=$value['username']?></div>
                            <div class="users__panel">
                                <a href="../user/chatroom.php?partnerName=<?=$value['username']?>"><img src="../assets/img/misc/write.png" alt="chat"></a>
                                <a href="../user/profile_see.php?watchUser=<?=$value['id']?>"><img src="../assets/img/misc/eye.png" alt="prof"></a>
                                <a href="#"><img src="../assets/img/misc/report.png" alt="report"></a>
                            </div>
                        </div>
                        <div class="users__card__info">
                            <div class="users__status">
                                <p>Статус: <?=$value['c_status']?></p>
                            </div>

                            <div class="users__hobbies">

                            </div>
                        </div>
                    </div>
                </div>

                <?endforeach;?>

            </div>
        </div>


        <div class="users__sect users__overseer">

        </div>


    </div

</div>


<?php

loadComponent('footer');

?>
