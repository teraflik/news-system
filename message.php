<?php
if (isset($_SESSION['MESSAGE'])) {
    echo '<div class="alert '; 
    if (isset($_SESSION['MESSAGE_TYPE'])) {
        echo $_SESSION['MESSAGE_TYPE'];
        unset($_SESSION['MESSAGE_TYPE']);
    }
    else{
        echo 'alert-warning';
    }
    echo '" role="alert">';
    if (isset($_SESSION['MESSAGE'])) {
        echo $_SESSION['MESSAGE'];
        unset($_SESSION['MESSAGE']);
    }
    echo '</div>';
}
?>