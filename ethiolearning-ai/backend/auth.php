<?php

declare(strict_types=1);

function start_secure_session(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_set_cookie_params([
            'httponly' => true,
            'samesite' => 'Lax',
            'secure' => isset($_SERVER['HTTPS']),
        ]);
        session_start();
    }
}

function require_login(): void
{
    start_secure_session();

    if (!isset($_SESSION['user_id'])) {
        header('Location: ../login.html');
        exit();
    }
}
