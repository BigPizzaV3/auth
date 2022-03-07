<?php
session_start();
include 'db_conn.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $header = "Location: ../login.php?error=";
    if (empty($username)) {
        header($header . "用户名为空");
    } else if (empty($password)) {
        header($header . "密码为空");
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->execute([$username]);

        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch();
            $user_username = $user['username'];
            $user_password = $user['password'];

            if ($username === $user_username && password_verify($password, $user_password)) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_type'] = $user['type'];
                $_SESSION['user_username'] = $user_username;
                $_SESSION['user_hwid'] = $user['hwid'];
                $_SESSION['user_last_change'] = $user['last_change'];
                $_SESSION['user_amount'] = $user['amount'];
                header("Location: ../index.php");
            } else {
                header($header . "用户名或密码错误");
            }
        } else {
            header($header . "账户不存在");
        }
    }
}
