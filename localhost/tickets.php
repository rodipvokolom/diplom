<?php
    include 'components/core.php';
    $config->pageName = "Тикеты"; 
    $config->thisPage = "ticketsPage";
    $uid = $_SESSION['user']['id'];
    $myTickets = $linki->query("SELECT `users`.*, `tickets`.*
        FROM `users` 
        LEFT JOIN `tickets` ON `tickets`.`user_id` = `users`.`id` WHERE `user_id` = '$uid'");
    $allTickets = $linki->query("SELECT `users`.*, `tickets`.*
        FROM `users` 
        LEFT JOIN `tickets` ON `tickets`.`user_id` = `users`.`id` WHERE `user_id` != '$uid'");
    loadComponent('header');

?>

<div class="tickets__main">
    <div class="tickets__wrapper">
        <?php if(isset($_SESSION['user'])):?>
        <div class="my__tickets">
            <div class="add__ticket">
            <h2 class="ticket__title__w" style="font-size:24pt; width:80%; margin:0 auto 0 auto;">Ваши тикеты:</h2>

                <div class="add__ticket__btn">
                    <button id="ticket__add__btn">Добавить тикет</button>
                </div>
                    <p><?=$_SESSION['error']['ticket']?></p>

                    <div id="ticket__popup" class="ticket__popup">
                        <div id="ticket__popup__inner" class="ticket__popup__inner">
                            <p id="ticket__popup__close">X</p>
                            <h2 style="font-size: 26pt; text-align:center;">Добавить заявку</h2>
                            <div class="add__ticket__form">
                                <form action="actions/user/tickets.php" method="POST">
                                <input type="text" name="title" id="" placeholder="Заголовок(ищу напарника/набираю в команду и т.п.)">                                    
                                <input type="text" name="specs" id="" placeholder="Вид деятельности (для чего/куда)">                                    
                                <textarea name="text" rows="8" id="add__ticket__text" placeholder="Подробнее..."></textarea>
                                <input type="submit" name="add__ticket" value="Подтвердить">
                                </form>
                            </div>

                        </div>
                    </div>

                    <div class="tickets__show">
                        <div class="tickets__show__wrapper">

                            <?php foreach ($myTickets as $key => $value):?>
                            <div class="ticket__body">
                                <div class="ticket__body__wrapper">
                                    <div class="ticket__username">
                                        <a href="../user/profile_see.php?watchUser=<?=$value['user_id']?>">
                                            <p><?=$value['username']?></p>
                                        </a>
                                    </div>

                                        <div class="ticket__title"><p><?=$value['t_title']?></p></div>
                                        <div class="ticket__spec"><p><?=$value['t_specs']?></p></div>
                                        <div class="ticket__text"><p><?=$value['t_text']?></p></div>
                                        <div class="ticket__misc">
                                            <form action="ticket.php" method="GET">
                                                <input type="hidden" name="tickID" value="<?=$value['id']?>">
                                                <input type="hidden" name="uID" value="<?=$value['user_id']?>">
                                                <input type="submit" name="tick_sub" value="Подробнее" id="ticket__more">
                                            </form>
                                            <form action="actions/user/tickets.php" method="POST">
                                                <input type="hidden" name="tickID" value="<?=$value['id']?>">
                                                <input type="submit" name="ticket_del" value="Удалить" id="ticket__more">
                                            </form>
                                        </div>
                                </div>
                            </div>
                            <?endforeach;?>

                        </div>
                    </div>
                </div>

            </div>
            <?php else:?>
                <br>
            <?php endif;?>        

            <div class="tickets__show">
                <h2 class="ticket__title__w" style="font-size:24pt; width:80%; margin:0 auto 0 auto;">Тикеты пользователей:</h2>
                            <div class="tickets__show__wrapper">

                            <?php foreach ($allTickets as $key => $value):?>
                            <div class="ticket__body">
                                <div class="ticket__body__wrapper">
                                    <div class="ticket__username">
                                        <a href="../user/profile_see.php?watchUser=<?=$value['user_id']?>">
                                            <p><?=$value['username']?></p>
                                        </a>
                                    </div>

                                        <div class="ticket__title"><p><?=$value['t_title']?></p></div>
                                        <div class="ticket__spec"><p><?=$value['t_specs']?></p></div>
                                        <div class="ticket__text"><p><?=$value['t_text']?></p></div>
                                        <div class="ticket__misc">
                                            <form action="ticket.php" method="GET">
                                                <input type="hidden" name="tickID" value="<?=$value['id']?>">
                                                <input type="hidden" name="uID" value="<?=$value['user_id']?>">
                                                <input type="submit" name="tick_sub" value="Подробнее" id="ticket__more">
                                            </form>
                                            <form action="actions/user/tickets.php" method="POST">
                                                <input type="hidden" name="tickID" value="<?=$value['id']?>">
                                            </form>
                                        </div>
                                </div>
                            </div>
                            <?endforeach;?>

                        </div>

            </div>
            
    </div>
</div>

<script src="../assets/scripts/jquery.js"></script>
<script src="../assets/scripts/script.js"></script>

<?php
    unset($_SESSION['error']);
    loadComponent('footer');
?>