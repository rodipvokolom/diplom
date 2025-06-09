<?php
    include '../../components/core.php';

    if(isset($_GET['submit_del'])){
        $mid = $_GET['id'];
        deleteRow('global_chat', 'id', $mid);
        redirect();
    }elseif($_SESSION['command'] == 'user-deleteAll'){
        $sender = $_SESSION['sender'];
        deleteRow('global_chat', 'user_id',$_SESSION['user']['id']);
        unset($_SESSION['command']);
        unset($_SESSION['sender']);
        header("Location: $sender");
    }else{
        redirect(); 
    }

?>