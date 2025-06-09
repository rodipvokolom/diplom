<?php
    include '../components/core.php';
    $config->pageName = "Редактирование профиля";
    $config->thisPage = "profilePage";
    $uid = $_SESSION['user']['id'];
    $userProfile = $linki->query("SELECT * FROM `users` JOIN `profile` ON `users`.`id` = `profile`.`user_id` WHERE `user_id` = $uid");
    $profileData = $userProfile->fetch_assoc();
    $pid = $profileData['id'];


    loadComponent('header');

?>
<br>
<br>
<br>
<br>
<br>
<a id="edit__back" href="profile.php"> < Вернуться</a>
<div class="edit__main">
    <div class="edit__wrapper">
    <div class="error__edit"><p style="text-align: center; color:brown; font-size:16pt;"><?=$_SESSION['error']['edit']?></p></div>

        <div class="edit__pfp">
            <div class="edit__pfp__c"><img src="../assets/img/user_pfp/<?=$profileData['pic']?>" alt=""></div>
            <div class="edit__pfp__change">
                <form action="../actions/user/profile.php" method="POST" enctype="multipart/form-data">
                    <!-- <div class="edit__pic"><img src="../assets/img/misc/upload.png" alt=""> -->
                    <label for="file-upload" class="custom-file-upload">
                        <i class="icon-upload"></i>
                    </label>
                    <input id="file-upload" name="upd_img" type="file">
                    <input class="edit__sub" type="submit" name="edit_pfp" value="Сменить аватар" />
                </form>
            </div>
        </div>
        
        <div class="spacer44"></div>

        <div class="edit__info">
            <h3 style="font-size: 20pt; text-align:center;">Немного о себе (500 симв. максимум)</h3>
            <form form action="../actions/user/profile.php" method="POST">
                <textarea maxlength="500" rows="9" cols="50" name="info_area" id="edit__info"><?=$profileData['user_info']?></textarea>
                <input class="edit__sub" type="submit" name="edit_info" value="Изменить">
            </form>
        </div>

        
        <div class="spacer44"></div>

        <div class="edit__username">
        <h3 style="font-size: 20pt; text-align:center;">Имя (необязательно) и псевдоним пользователя</h3>   
            <div class="edit__username__forms">

                <form action="../actions/user/profile.php" method="POST">
                    <input class="edit__name__field" type="text" name="rn_f" id="" value="<?=$profileData['real_name']?>">
                    <input class="edit__sub"  name="edit_rn" type="submit" value="Изменить имя">
                </form>

                <form action="../actions/user/profile.php" method="POST">
                    <input class="edit__name__field" type="text" name="nick_f" id="" value="<?=$profileData['username']?>">
                    <input class="edit__sub" type="submit" name="edit_nickname" value="Изменить псевдоним">
                </form>
            </div>
        </div>

        <div class="spacer44"></div>

        
        <div class="edit__info">
            <h3 style="font-size: 20pt; text-align:center;">Статус (120 симв. максимум):</h3>
            <form form action="../actions/user/profile.php" method="POST">
                <textarea maxlength="120" rows="4" cols="12" name="stat_area" id="edit__stat"><?=$profileData['c_status']?></textarea>
                <input class="edit__sub" type="submit" name="edit_stat" value="Изменить">
            </form>
        </div>

    </div>
</div>

<?php
loadComponent("footer");

    unset($_SESSION['error']['edit']);
?>