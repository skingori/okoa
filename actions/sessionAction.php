<?php
function createIssetSession($messsage, $key="error") {
    session_start();
    return $_SESSION[$key] = $messsage;
}

function sessionDestory() {
    session_start();
    session_unset();
    session_destroy();
}
?>