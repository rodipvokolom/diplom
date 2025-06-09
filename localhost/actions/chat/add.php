<?php
    include '../../components/core.php';
    $uid = $_SESSION['user']['id'];
    $n = $_POST['chat_message'];
    $d = date("Y-m-d H:i:s");
    $_POST['date_created'] = $d;
    // $_SESSION['chatError'] = 'fe';
    
    if(isset($_POST['send'])){
        if(empty($_POST['chat_message']) || ctype_space($_POST['chat_message']) == true || ctype_space($_POST['chat_message'][0]) == true){
            $_SESSION['chatError'] = 'Поле ввода не может быть пустым и не может начинаться с пробела';
            redirect();
        }else{
            

            $linki->query("INSERT INTO `global_chat`( `user_id`, `chat_message`, `date_created`) 
            VALUES ('$uid', '$n', '$d')");
            redirect();
                   }   
                }
        

?>