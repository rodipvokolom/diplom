<?php


include 'components/core.php';


$ticketId = $_GET['tickID'];
$userId = $_GET['uID'];

$getTicket = $linki->query("SELECT * FROM `tickets` WHERE `id` = '$ticketId'");
$gt = $getTicket->fetch_assoc();
$getProfile = $linki->query("SELECT * FROM `profile` WHERE `user_id` = '$userId'");
$gp = $getProfile->fetch_assoc();
$getUser = $linki->query("SELECT * FROM `users` WHERE `id` = '$userId'");
$gu = $getUser->fetch_assoc();
$getComms = $linki->query("SELECT `users`.*, `ticket_chat`.*
    FROM `users` 
	LEFT JOIN `ticket_chat` ON `ticket_chat`.`user_id` = `users`.`id` WHERE `ticket_id` = '$ticketId'");

if($userId == $uid){
    $is_editable = 1;
}else{
    $is_editable = 0;
}   

$config->pageName = "Тикет ".$gu['username']."'a";
$config->thisPage = "ticketsPage";
loadComponent('header');

?>
<div class="ticket__view__main">
    <h2 style="font-size: 28pt; text-align:center;margin-bottom:24pt;">Тикет <?=$gu['username']?>'a</h2>
    <div class="ticket__view__wrapper">
        <a id="back__view" href="tickets.php"><Вернуться</a>
        <div class="ticket__view__body">
            <div class="ticket__view__user">
                <a href="../user/profile_see.php?watchUser=<?=$userId?>">
                    <div class="ticket__view__pfp"><img src="assets/img/user_pfp/<?=$gp['pic']?>" alt=""></div>
                    <div class="ticket__view__username"><?=$gu['username']?></div>
                </a>
            </div>

            <div class="ticket__view__info">
                <div class="view__title">
                    <p><?=">".$gt['t_title']?></p>
                </div>

                <div class="view__specs">
                    <p><?=$gt['t_specs']?></p>
                </div>

                <div class="view__text">
                    <p><?=$gt['t_text']?></p>
                </div>
            </div>
        </div>

    </div>
    <div class="spacer123a"></div>
    <div class="ticket__comment__wrapper">
        <?php if(isset($_SESSION['user'])):?>
        <h3 style="font-size:20pt;">Оставить сообщение:</h3>
        <div class="ticket__comm__form">
            <form action="actions/user/tickets.php" method="post">
                <input type="hidden" value="<?=$ticketId?>" name="ticketcID">
                <textarea rows="2" cols="100" name="ticket__comm__txt" placeholder="Текст сообщения..." id=""></textarea>
                <input type="submit" name="sub__ticket__comm" value="Отправить">
            </form>
        </div>
        <?php else:?>
            <p>Для того, чтобы откликнуться на тикет, необходимо авторизоваться!</p>
        <?endif;?>

        <div class="ticket__comm__sect">

            <?php foreach ($getComms as $key => $value):?>
            <div class="ticket__comm__body">
                <div class="ticket__comm__user">
                    <a href="../user/profile_see.php?watchUser=<?=$value['user_id']?>">
                        <?=$value['username']." оставил сообщение:"?>
                    </a>
                </div>
                <div class="ticket__comm__text"><p><?=">>".$value['ticket_msg']?></p></div>
            </div>
            <?endforeach;?>

        </div>
    </div>

</div>

<?php
    loadComponent("footer");

?>