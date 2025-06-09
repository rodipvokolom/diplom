<?php

    include("../../components/core.php");
    $uid = $_SESSION['user']['id'];

    if(isset($_POST['del_reach'])){
        $delId = $_POST['reach_id'];

        $linki->query("DELETE FROM `user_contact` WHERE `id` = '$delId'");
        redirect();
    }

    if(isset($_POST['reach_sub'])){
        $rplat = $_POST['platform_select'];
        $rdata = $_POST['reach__data'];
        $profSelect = $linki->query("SELECT * FROM `profile` WHERE `user_id` = '$uid'");
        $profId = $profSelect->fetch_assoc();
        $pid = $profId['id'];
        if(empty($rdata) || !isset($rdata) || ctype_space($rdata)){
            $_SESSION['error']['reach'] = 'Error[reach data]: поле не должно быть пустым.';
            redirect();
        }else{

            switch ($rplat) {
                case 'Discord':
                    $linki->query("INSERT INTO `user_contact` (`prof_id`, `platform`, `data`, `plat_pic`) 
                                   VALUES ('$pid','$rplat','$rdata', 'discord.png')");
                    break;
                case 'VKontakte':
                    $linki->query("INSERT INTO `user_contact` (`prof_id`, `platform`, `data`, `plat_pic`) 
                                   VALUES ('$pid','$rplat','$rdata', 'vk.png')");
                    break;
                case 'Telegram':
                    $linki->query("INSERT INTO `user_contact` (`prof_id`, `platform`, `data`, `plat_pic`) 
                                   VALUES ('$pid','$rplat','$rdata', 'tg.png')");
                    break;
                case 'E-mail':
                    $linki->query("INSERT INTO `user_contact` (`prof_id`, `platform`, `data`, `plat_pic`) 
                                   VALUES ('$pid','$rplat','$rdata', 'email.png')");
                    break;
                default:
                    break;
            }

            // redirect();
        }
        redirect();
    }
?>