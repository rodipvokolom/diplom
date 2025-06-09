<?php
    include '../../components/core.php';
    $n = $_POST['username'];
    $e = $_POST['email'];
    $p = $_POST['password'];
    $r = $_POST['repass'];

    if(isset($_POST['reg'])){
        // echo 'registration';
        if(!empty($n) && !empty($e) && !empty($p) && !empty($r)){
        
            if($p !== $r){
                error("Пароли не совпадают");
            }elseif($p == $r){
            
            $arr = ['username', 'email', 'password'];
            $values = emptyValues($arr, $_POST);
            if($values){
                // $values['password'] = md5($values['password']);
                $query = $link ->prepare("SELECT * FROM `users` 
                WHERE `username` = :username");

                $query->execute(['username' => $_POST['username']]);
                
                $user = $query->fetch();
                
                error("Уч. запись успешно создана! Войдите через Log In.");
                if(!$user){
                    insert("users", $arr, $values);
                    redirect();
                }else{
                    error("Пользователь с таким именем/эл. почтой уже существует");
                }
        }
            }


        }else{
            error("Поля не должны быть пустыми");
        }
                
    }elseif(isset($_POST['log'])){
        if(!empty($_POST['username']) && !empty($_POST['password'])){
            $arr = ['username', 'password'];
            $values = emptyValues($arr, $_POST);
            // $values['password'] = md5($values['password']);
            
            $query = $link->prepare("SELECT * FROM `users` 
            WHERE `username` = :username AND `password` = :password");
            
            $query->execute($values);
            $user = $query->fetch();
            $uidP = $user['id'];
            if($user){
                $testP = $linki->query("SELECT * FROM `profile` WHERE `user_id` = '$uidP'");
                if($testP->num_rows !== 1){
                    $linki->query("INSERT INTO 
                    `profile` (`user_id`, `pic`, `is_created`, `c_status`, `real_name`, `user_info`) 
                    VALUES ('$uidP', 'placeholder.png', '1', 'Не указано', 'Не указано', 'Не указано')");
                }else{
                    error('Произошел сбой. Повтороте попытку.');
                }


                $_SESSION['user'] = [
                    "id" => $user['id'],
                    "username" => $user['username'],
                ];
                
                redirect("index");
            }else{
                error("Неверный логин/пароль");
            }
        }elseif(empty($_POST['username']) || empty($_POST['password'])){
            error('Поля не должны быть пустыми');
        }

    }else{
        redirect('index');
        $_SESSION['error'] = 'Access denied';
    }

?>