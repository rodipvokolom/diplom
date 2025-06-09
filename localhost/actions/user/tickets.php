<?php
    include '../../components/core.php';

    $uid = $_SESSION['user']['id'];
    $tid = $_POST['tickID'];
    if(isset($_POST['add__ticket'])){
        $title = $_POST['title'];
        $spec = $_POST['specs'];
        $txt = $_POST['text'];
        if(empty($title) || ctype_space($title) || empty($spec) || ctype_space($spec) || empty($txt) || ctype_space($txt)){
            $_SESSION['error']['ticket'] = "Error[tickets]:Поля не могут быть пустыми";
            redirect();
        }else{

            $linki->query("INSERT INTO `tickets`(`user_id`, `t_title`, `t_text`, `t_specs`) 
            VALUES ('$uid', '$title', '$txt', '$spec')");
            redirect();
        }
    }elseif(isset($_POST['ticket_del'])){
        $linki->query("DELETE FROM `tickets` WHERE `id` = '$tid'");
        redirect();
    }elseif(isset($_POST['sub__ticket__comm'])){
        $uid = $_SESSION['user']['id'];
        $ticketIDa = $_POST['ticketcID'];
        $comm_txt = $_POST['ticket__comm__txt'];
        $linki->query("INSERT INTO `ticket_chat` (`ticket_id`, `user_id`, `ticket_msg`) 
        VALUES ('$ticketIDa', '$uid', '$comm_txt')");
        redirect();
    }
    else{
        redirect();
    }
?>