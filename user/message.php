<?php
if (isset($_SESSION['message'])) {
    echo "<div class='alert alert-" . $_SESSION['message_type'] . " alert-dismissible'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>
    " . $_SESSION['message'] . "
    </div>";
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>