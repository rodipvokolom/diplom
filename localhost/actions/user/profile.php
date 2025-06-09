<?php

    include("../../components/core.php");

    $uid = $_SESSION['user']['id'];
    $getProf = $linki->query("SELECT * FROM `profile` WHERE `user_id` = '$uid'");
    $getUser = $link->query("SELECT * FROM `users` WHERE `id` = '$uid'");

    if(isset($_POST['edit_pfp'])){
            $img = $_FILES['upd_img'];
                if('image' == substr($img['type'], 0, 5) && isset($img)){
                    $uid = $_SESSION['user']['id'];
                    $uimg = strval(uniqid().'.'.substr($img['type'], 6));
                    move_uploaded_file($img['tmp_name'], "../../assets/img/user_pfp/$uimg");
                    $linki->query("UPDATE `profile` SET `pic` = '$uimg' WHERE `user_id` = '$uid'");
                    redirect();
                    }else{
                        $_SESSION['error']['edit'] = 'Error[profile pic]: Произошел сбой. Проверьте расширение файла и попробуйте снова.';
                        redirect();
                    }

    }elseif(isset($_POST['edit_info'])){
        $uinfo = $_POST['info_area'];
        if(empty($uinfo) || !isset($uinfo) || ctype_space($uinfo)){
            // echo 'info error';
            $linki->query("UPDATE `profile` SET `user_info` = 'Не указано' WHERE `user_id` = '$uid'");
            redirect();
        }else{
            $linki->query("UPDATE `profile` SET `user_info` = '$uinfo' WHERE `user_id` = '$uid'");
            redirect();
        }
    }elseif(isset($_POST['edit_rn'])){
        $urn = $_POST['rn_f'];
        if(empty($urn) || !isset($urn) || ctype_space($urn)){
            // echo 'info error';
            $linki->query("UPDATE `profile` SET `real_name` = 'Не указано' WHERE `user_id` = '$uid'");
            redirect();
        }else{
            $linki->query("UPDATE `profile` SET `real_name` = '$urn' WHERE `user_id` = '$uid'");
            redirect();
        }

    }elseif(isset($_POST['edit_nickname'])){
        $unick = $_POST['nick_f'];
        if(empty($unick) || !isset($unick) || ctype_space($unick)){
            // echo 'info error';
            $_SESSION['error']['edit'] = 'Error[username]: Поле псевдонима не может быть пустым.';
            redirect();
        }else{
            $linki->query("UPDATE `users` SET `username` = '$unick' WHERE `id` = '$uid'");
            
            redirect();
        }

    }elseif(isset($_POST['edit_stat'])){
        $ustat = $_POST['stat_area'];
        if(empty($ustat) || !isset($ustat) || ctype_space($ustat)){
            // echo 'info error';
            $linki->query("UPDATE `profile` SET `real_name` = 'Не указано' WHERE `user_id` = '$uid'");
            redirect();
        }else{
            $linki->query("UPDATE `profile` SET `c_status` = '$ustat' WHERE `user_id` = '$uid'");
            redirect();
        }

    }
?>