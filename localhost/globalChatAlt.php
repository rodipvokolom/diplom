<?php
    $data = $_POST['data'];
    $dt = json_decode($data);
    include 'components/core.php';
    include 'components/contextMenu.php';
    $config->pageName = "Global Terminal";
    $config->thisPage = "globalChatTerminal";
    loadComponent('header');
    $usernames = $link->query("SELECT * FROM `users` JOIN `global_chat` 
    ON `users`.`id` = `global_chat`.`user_id` ORDER BY `date_created` ASC");

    $activeUsers = $link->query("SELECT * FROM `users` WHERE `id` = {$_SESSION['user']['id']}");
    $activeUser = $activeUsers->fetch();
    // foreach($usernames as $k => $val){
    //     echo $val['username']."<hr>";
    // }
    //  WHERE `user_id` = `user_id`.`id`
    function isUser($uid){
        if($uid == $_SESSION['user']['id']){
            return 'id="active__user__target"';
        }
    }
?>

<div class="context-menu"id="contextMenu">

    <ul class="menuList">
        <li onclick="getId()" id="viewProfile"><a href="#">Просмотр профиля</a></li>
        <li id="report"><a href="#">Отправить жалобу</a></li>
        <li onclick="copyText()" id="placeholder"><a href="">Copy</a></li>
        <li onclick="pasteText()" id="paste"><a href="">Paste</a></li>
        <li onclick="reload()" id="placeholder"><a href="">Reload</a></li>
    </ul>

</div>
<h1 style="color:white;" ><?=$dt?></h1>

<div class="main__wrapper">

    <div class="alt__chat__body">
        <div class="alt__chat__wrapper">
            <?php foreach($usernames as $key => $value): ?>
                <div class="alt__chat__message__body">
                    <div class="message__wrapper">
                        <div id="uscl" class="alt__chat__username userClick"><p>//global_channel-1-en//(<span class="span_date"><?=$value['date_created'];?></span>)<span data-userId="<?=$value['user_id'];?>" <?=isUser($value['user_id']);?> class="<?=roleCheck($value['role']);?>" ><?="[".$value['role'];?>]::<?=$value['username'];?>>></span></p></div>
                        <div class="alt__message__text"><p><?=$value['chat_message'];?></p></div>
                    </div>
                </div>
                <?endforeach;?>
            </div>
        </div>
        
        
        
        <div class="alt__text__input__field">
            <div class="alt__input__wrapper">
                <form <?=action("chat/add");?>>
                    <input type="hidden" name="user_id" value="<?=$_SESSION['user']['id'];?>">
                    <input type="text" autofocus name="chat_message" <?=ifError("Type message in chat or /help for command list");?>>
                    <p>[<?="".$activeUser['role']."::".$_SESSION['user']['username']?>]//<span id="a" class="anim">#</span></p>
                    <input type="submit" name="send" value=">>>">
                </form>
        </div>
    </div>

</div>

<script>

    document.onclick = hideMenu;
    document.oncontextmenu = rightClick;
    
    

    function hideMenu() {
        document.getElementById("contextMenu").style.display = "none";
    }


    function rightClick(e) {
        e.preventDefault();

        if(document.getElementById("contextMenu").style.display == "block") {
            hideMenu();
        }else{
 
                var menu = document.getElementById("contextMenu");
                menu.style.display = 'block';
                menu.style.left = e.pageX - 200 + "px";
                menu.style.top = e.pageY - 130 + "px";
     
            
        }
    }
    function copyText(){
        document.execCommand('copy'); 
    }
    function pasteText(){
        document.execCommand('paste');
    }
    function pageRefresh(){
        location.reload();
    }

    const loc = document.querySelectorAll('span[data-userId]');
    loc.forEach(node =>{
    node.addEventListener("mouseover", locOver);
    node.addEventListener("mouseout", locOut);
    });

    function locOver(event){
        console.log('mouseover', event.target.dataset)

        // alert(parseInt(this.dataset));


        // $.ajax({
        //     type: "POST",
        //     url: "globalChatAlt.php",
        //     dataType:"json",
        //     data:{
        //         onUser: event.target.dataset,
        //     },
        //     success:function(data){alert("sucksass")},
        //     error:function(data){alert("smellsshit")}
        // })
    }
    function locOut(){
        console.log('locOut');
    }

    function getId(){
       variableString = 'sent data';
       jQuery.ajax({
       type: "POST",
       url: "test.php",
       data: variableString,
       success: function(msg){
         alert( "Data Saved: " + msg )}})};

// // ///////////////////////////////////////////////////////////////////////////////////////
//     document.oncontextmenu = cntm;
//     function cntm(e){
//         e.preventDefault();

//         if(document.oncontextmenu){
//             alert("Context menu call")

//         }

//     }

</script>




<?php
    loadComponent("footer");

    unset($_SESSION['chatError']);
?>