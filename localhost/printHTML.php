<?php
    function printInput($name, $label, $type="text", $required=true){
        $id = uniqid();
        $value = isset($_SESSION['values'][$name]) ? $_SESSION['value'][$name] : '';
    
?>

<p>
    <label for="<?=$id;?>"><?=$label;?></label>
    <input 
    type="<?=$type;?>" 
    name="<?=$name;?>"
    id="<?=$id;?>"
    value="<?=$value;?>"
    placeholder="<?=$label;?>"
    <?=($required) ? "required" : '';?>
    >   
    <?= (isset($_SESSION['errors'][$name])) ? "<span>{$_SESSION['errors'][$name]}</span>" : "" ?>
    <?php unset($_SESSION["errors[$name]"]); ?>
</p>

<?php

    }
    function printError(){
        if(isset($_SESSION['errorForm'])){
            echo "<p>{$_SESSION['errorForm']}</p>"; 
            unset($_SESSION['errorForm']);
        }
    }

?>