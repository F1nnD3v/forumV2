<?php
    session_destroy();
    header('Location: login.php');
    setcookie("login_session_key", "", time() + (86400 * 3));
?>