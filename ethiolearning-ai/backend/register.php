<?php

declare(strict_types=1);

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$fullName = trim($_POST['full_name'] ?? '');
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$password = $_POST['password'] ?? '';
$grade = (int) ($_POST['grade'] ?? 0);
$stream = trim($_POST['stream'] ?? '');
$stream = $stream === '' ? null : $stream;

if ($fullName === '' || !$email || strlen($password) < 8 || !in_array($grade, [9, 10, 11, 12], true)) {
    http_response_code(422);
    exit('Invalid input data.');
}

if (in_array($grade, [11, 12], true) && !in_array($stream, ['Natural', 'Social'], true)) {
    http_response_code(422);
    exit('Stream is required for grade 11 and 12.');
}

if (in_array($grade, [9, 10], true)) {
    $stream = null;
}

$checkStmt = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
$checkStmt->execute(['email' => $email]);
if ($checkStmt->fetch()) {
    http_response_code(409);
    exit('Email already registered.');
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$insertStmt = $pdo->prepare(
    'INSERT INTO users (full_name, email, password, grade, stream) VALUES (:full_name, :email, :password, :grade, :stream)'
);

$insertStmt->execute([
    'full_name' => $fullName,
    'email' => $email,
    'password' => $hashedPassword,
    'grade' => $grade,
    'stream' => $stream,
]);

start_secure_session();
$_SESSION['user_id'] = (int) $pdo->lastInsertId();
$_SESSION['email'] = $email;
$_SESSION['role'] = 'user';

header('Location: ../dashboard.php');
exit();
