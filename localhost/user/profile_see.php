<?php
    include '../components/core.php';

    $uid = $_GET['watchUser'];
    $userProfile = $linki->query("SELECT * FROM `users` JOIN `profile` ON `users`.`id` = `profile`.`user_id` WHERE `user_id` = '$uid'");
    $profileData = $userProfile->fetch_assoc();
    $pid = $profileData['id'];


    $checkUserP = $linki->query("SELECT * FROM `profile` WHERE `user_id` = '$uid'");

    $userContact = $linki->query("SELECT * FROM `user_contact` WHERE `prof_id` = '$pid'");

    $userHobbies = $linki->query("SELECT * FROM `hobbies` WHERE `profile_id` = '$pid'");

    $userContact = $linki->query("SELECT * FROM `user_contact` WHERE `prof_id` = '$pid'");
    $config->pageName = "Профиль ".$profileData['username']."'a";
    $config->thisPage = "usersPage";
    loadComponent('header');
?>




<br>


<div class="prof__sect">

    <div class="prof__wrapper">
        <div class="user__tab">

            <div class="user__pic">
                <div class="user__prof__pic">
                    <img src="../assets/img/user_pfp/<?=$profileData['pic']?>" alt=":(">
                </div>

                <div class="<?=roleCheck($profileData['role'])?>"><p style="font-size: 16pt; margin-top:12px;">[<?=$profileData['role']?>]</p></div>
                <div class="user__nick"><p><?=$profileData['username']?></p></div>
                <div class="user__rn"><p><?=$profileData['real_name']?></p></div>
            </div>

            <div class="user__info">
                <div class="user__status"><p><span style="text-decoration: underline; font-size:20pt;">Статус</span>: <?=$profileData['c_status']?></p></div>
                <div class="user__bio"><p id="about__t">Про себя:</p><p id="about_d"><?=$profileData['user_info']?></p></div>
            </div>

        </div>
    </div>
    <div class="spacer11"></div>
    <div class="user__reach">
        <div class="reach__wrapper">
            <div class="reach__how">Как со мной связаться:</div>


            <div id="reach__popup" class="reach__popup">
                <div class="reach__popup__inner">
                    <p id="popup__reach__close">X</p>
                    <div class="reach__add__main">
                    <h2 style="font-size: 28pt; text-align:center;">Добавить способ связи</h2>
                        <div class="reach__add__wrapper">
                        <form action="../actions/user/add_reach.php" method="POST">
                            <select name="platform_select" id="">
                                <option value="Discord">Discord</option>
                                <option value="VKontakte">ВКонтакте</option>
                                <option value="Telegram">Telegram</option>
                                <option value="E-mail">E-mail</option>
                            </select>
                            <input type="text" name="reach__data" id="" placeholder="ID/тэг/эл.адрес и т.п.">
                            <input class="edit__sub" type="submit" name="reach_sub" value="Добавить">
                        </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="reach__cards">

                <?php foreach ($userContact as $key => $value):?>
                    <div class="reach__card">
                        <div class="reach__card__title">
                            <div class="reach__pic"><img src="../assets/img/contact_platforms/<?=$value['plat_pic']?>" alt=""></div>
                            <div class="reach__title"><p><?=$value['platform']?></p></div>
                        </div>

                        <div class="reach__card__data">
                            <p><?=$value['data']?></p>
                        </div>
                    </div>
                <? endforeach;?>
  
            </div>

        </div>
    </div>

    <div class="spacer11"></div>


    <div class="hobbies__sect">
        <div class="reach__how">Мои увлечения:</div>

        <div class="hobbies__wrapper">

<div id="hobby__popup" class="reach__popup">
    <div class="reach__popup__inner">
        <p id="popup__hobby__close">X</p>
        <div class="hobby__add__main">
        <h2 style="font-size: 28pt; text-align:center;"></h2>
            <div class="reach__add__wrapper">
            <form action="../actions/user/add_hobby.php" method="POST">
                <select name="hobby_select" id="">
                    <option value="Tabletop">Настольные игры</option>
                    <option value="Sports">Спорт</option>
                    <option value="Gaming">Видеоигры</option>
                </select>
                <input type="text" name="hobby__title" id="" placeholder="Название увлечения">
                <textarea style="font-size: 24pt; border-radius:4px;" rows="2" name="hobby__text" id="" placeholder="Опыт/часы/уровень навыка..."></textarea>
                <input class="edit__sub" type="submit" name="hobby_sub" value="Добавить">
            </form>
            </div>
        </div>
    </div>
</div>

<div class="reach__cards">

    <?php foreach ($userHobbies as $key => $value):?>
        <div class="reach__card">

            <div class="reach__card__title">
                <div class="reach__pic"><img src="../assets/img/hobbies/<?=$value['hobby_pic']?>" alt=""></div>
                <div class="reach__title"><p><?=$value['title']?></p></div>

            </div>

            <div class="reach__card__data">
                <p><?=$value['description']?></p>
            </div>
        </div>
    <? endforeach;?>

</div>

        </div>
    </div>
</div>

<script src="../assets/scripts/jquery.js"></script>
<script src="../assets/scripts/script.js"></script>


<!-- vyser -->



<?
    loadComponent('footer');
    unset($_SESSION['sender']);
    unset($_SESSION['error']);
?>