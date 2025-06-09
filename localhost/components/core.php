<?php
    session_start();
    include "config.php";

    $linki = mysqli_connect('localhost', 'root', '', 'project_o');
    $link = $dbh = new PDO('mysql:dbname=project_o;host=localhost:3306', 'root', '');

    $root = $_SERVER['CONTEXT_DOCUMENT_ROOT'].$config->root;

    function loadComponent($file){
        global $root, $config;
        
        // return include "components/".$file;
        $file = $file.".php";
        if(file_exists("$root/components/$file")){
            include "$root/components/$file";
        }else{
            echo "Error: $file does not exist";
        }
    }

    function multiVal(...$n_amount_of_values){
        
    }


    function hrefR($url){
        global $config;
        $url = ($config->root == '') ? "/$url.php" : "$config->root/$url.php";
        return " href='$url'";
    }

    function is_active($active){
        global $config;
        if($active == $config->thisPage){
            return $active = "active";
        }
    }

    function redirect($url = false){
        global $config;
        if($url){
            $url = ($config->root == '') ? "/$url.php" : "/$config->root/$url.php";
            header("Location: $url");
        }else{
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }

        // if($url && $t){
        //     $url = ($config->root == '') ? "/$url.php" : "/$config->root/$url.php";
        //     header("Refresh = $t; url=$url.php");
        // }
        // if(!$url && !$t){
            // header("Refresh: 6; url={$_SERVER['HTTP_REFERER']}");
        // }
        // if($url && !$t){
        //     $url = ($config->root == '') ? "/$url.php" : "/$config->root/$url.php";
        //     header("Refresh: 0; url=$url.php");
        // }
        // if(!$url && $t){
        //     header("Refresh: $t; url={$_SERVER['HTTP_REFERER']}");
        // }
    }

    function emptyValues($keyValue, $values){
        $arrValues = [];
        foreach($keyValue as $key => $value){
            if(empty($values[$value])){
                $_SESSION['error'][$value] = "Поле обязательно к заполнению";
            }else{
                $_SESSION['values'][$value] = $values[$value];
            }
            $arrValues[$value] = $values[$value];
                
        }
            
        if(isset($_SESSION['error'])){
            redirect();
        }
        return $arrValues;
    }

    function error($str){
        $_SESSION['errorForm'] = $str;
        redirect();
    }



    function action($url, $method="POST"){
        global $config;
        $url = ($config->root == "") ? "/actions/$url.php" : "$config->root/actions/$url.php";
        return " action='$url' method='$method'";
    }

    function insert($tableName, $arrVal, $values){
        global $link;
        
        $set = "";
        foreach($arrVal as $key => $value){
            $set .= " `$value` = :$value, ";
        }
        $set = substr($set, 0, -2)." ";

        $query = $link->prepare("INSERT INTO `$tableName` SET $set");

        $query->execute($values);
    }

    function get($tableName, $id){
        global $link;
        $query = $link->prepare("SELECT * FROM `$tableName` WHERE `id` = :id");
        $query->execute(['id' => $id]);
        return $query->fetch();   
    }

    function checkIfZero($tableName, $vid){
        global $link;
        $query = $link->prepare("SELECT * FROM `$tableName` WHERE `id` = $vid");
        $query->execute();
        $rc = $query->rowCount();
        if($rc == 0){
            return true;
        }else{
            return false;
        }   
    }



    function deleteRow($tableName, $row,$param){
        global $link;
        $query = $link->prepare("DELETE FROM `$tableName` WHERE `$row` = $param");
        $query->execute();
        return $query->fetch();
    }

    function ifError($p){

        if(isset($_SESSION['chatError'])){
            return 'id="input__error" placeholder="'.$_SESSION['chatError'].'"';
        }else{
            return 'placeholder="'.$p.'"';
        }
        
    }

    function commandLine($type, $parameter){

    }

    function roleCheck($value){
        switch($value){
            case 'overlord':
                return 'role__name__overlord';
            case 'arbiter':
                    return 'role__name__arbiter';
            case 'overseer':
                    return 'role__name__overseer';
            case 'observer':
                return 'role__name__observer';
            default:
                return 'role__name__undefined';
        }
    }

?>
