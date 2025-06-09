<?php
    include 'components/core.php';

    $config->pageName = "Главная";
    $config->thisPage = "index";
    loadComponent("header");


?>

<div class="index__main">
    <div class="index__wrapper">

        <!-- <div class="index__window">
            <h1>«Каждой тваре по паре...»</h1>
            <p>Значит и вам тоже достанется! Данный сервес предоставляет возможность 
                найти тех, с кем можно будет приятно провести время и кто разделит с вами досуг! 
                И не важно какая сфера: будь то видеоигры, настолки или даже спорт!
             </p> -->
            <div class="index__button">

                <?php if(isset($_SESSION['user'])):?>
                    <a class="indexA" href="tickets.php">Начать!</a>
                    <?else:?>
                    <a class="indexA" href="authPage.php">Начать!</a>
                <?endif;?>   
            </div>
        </div>

    </div>
</div>



<?php

    loadComponent("footer");

?>