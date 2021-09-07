<?php
    session_destroy();
    $msg_error = "vous êtes bien déconnecté";
header("Location: home?msg=$msg_error&error=false");