<?php
    include 'components/core.php';
    $config->pageName = "Авторизация";
    $config->thisPage = "authPage";
    loadComponent("header");
?>

    <section class="auth__sect">

        <div class="form__container">
            <div class="switch">
                <a class="" href="authPage.php?mode=reg">Зарегистрироваться</a>
                <span>|</span>
                <a class="" href="authPage.php?mode=log">Войти</a>
            </div>
            <?if(isset($_GET['mode']) && $_GET['mode'] == "reg"):?>
            <form <?=action("user/auth");?>> 
                <input type="text" name="username" placeholder="Логин (16 симв. максимум)">
                <input type="email" name="email" placeholder="Эл. почта">
                <input type="password" name="password" placeholder="Пароль">
                <input type="password" name="repass" placeholder="Repeat password">
                <input type="submit" name="reg" value="Регистрация">
            </form>
            <?elseif(isset($_GET['mode']) && $_GET['mode'] == "log"):?>
            <form <?=action("user/auth");?>>
                <input type="text" name="username" placeholder="Логин">
                <input type="password" name="password" placeholder="Пароль">
                <input type="submit" name="log" value="Войти">
            </form>
            <?endif;?>
        </div>
        <?php if(isset($_SESSION['errorForm'])):?>
        <div class="errorField">
            <div class="errorWrap">
                <p><span>[</span><?=$_SESSION['errorForm']?><span>]</span></p>
            </div>
        </div>
        <?endif;?>
    </section>








<?php
unset($_SESSION['errorForm']);
loadComponent("footer");
?>