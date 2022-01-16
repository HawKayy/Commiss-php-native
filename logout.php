<?php
session_start();
session_destroy();
session_start();
$_SESSION ['status_login'] = false;
echo '<script>window.location="login.php"</script>';


?>