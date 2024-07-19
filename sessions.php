<?php
include('actions/sessionAction.php');

// Check, if user is already login, then jump to secured page
if (isset($_SESSION['email'])) {
    header('Location: user/index.php');
} else {
    sessionDestory();
    header('Location: index.php');
}

?>