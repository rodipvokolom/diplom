<?php
    include "../../components/core.php";
    session_unset();
    session_destroy();
    redirect('index');
?>