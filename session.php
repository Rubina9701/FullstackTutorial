<?php
// session.php

// Secure session cookie settings
session_set_cookie_params([
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();
?>
