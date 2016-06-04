<?php

$_SESSION = array();
session_unset();
session_destroy();
setcookie('membre');
setcookie('hash');
header('Location: ?');
exit();