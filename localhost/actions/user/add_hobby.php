<?php

    include("../../components/core.php");
    $uid = $_SESSION['user']['id'];

    if(isset($_POST['del_hobby'])){
        $delId = $_POST['hobby_id'];

        $linki->query("DELETE FROM `hobbies` WHERE `id` = '$delId'");
        redirect();
    }

    if(isset($_POST['hobby_sub'])){
        $title = $_POST['hobby__title'];
        $text = $_POST['hobby__text'];
        $hb = $_POST['hobby_select'];
        $profSelect = $linki->query("SELECT * FROM `profile` WHERE `user_id` = '$uid'");
        $profId = $profSelect->fetch_assoc();
        $pid = $profId['id'];
        if(empty($text) || !isset($text) || ctype_space($text)){
            $_SESSION['error']['reach'] = 'Error[reach data]: поле не должно быть пустым.';
            redirect();
        }else{

            switch ($hb) {
                case 'Tabletop':
                    $linki->query("INSERT INTO `hobbies`(`profile_id`, `title`, `description`, `hobby_pic`) 
                    VALUES ('$pid', '$title', '$text', 'chess.png')");
                    break;
                case 'Sports':
                    $linki->query("INSERT INTO `hobbies`(`profile_id`, `title`, `description`, `hobby_pic`) 
                    VALUES ('$pid', '$title', '$text', 'sports.png')");
                    break;
                case 'Gaming':
                    $linki->query("INSERT INTO `hobbies`(`profile_id`, `title`, `description`, `hobby_pic`) 
                    VALUES ('$pid', '$title', '$text', 'gaming.png')");
                    break;
                default:
                    break;
            }
        }
        redirect();
    }
?>