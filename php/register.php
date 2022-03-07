<?php
session_start();
include 'db_conn.php';

if (isset($_POST['key']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
    $key = $_POST['key'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $header = "Location: ../register.php?error=";
    if (empty($key)) {
        header($header . "密钥为空");
    } else if (empty($username)) {
        header($header . "用户名为空");
    } else if (empty($password)) {
        header($header . "密码为空");
    } else if (empty($confirm_password)) {
        header($header . "确认密码为空");
    } else if ($password != $confirm_password) {
        header($header . "确认密码与密码不一致");
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->execute([$username]);

        if ($stmt->rowCount() === 0) {
            $stmt = $conn->prepare("UPDATE keytab SET user=?,use_date=? WHERE key_name=? AND user=?");
            $stmt->execute([$username, time(), $key, ""]);
            if ($stmt->rowCount() === 1) {
                $stmt = $conn->prepare("SELECT * FROM keytab WHERE key_name=?");
                $stmt->execute([$key]);

                $key = $stmt->fetch();
                $type = $key['type'];
                $superior = $key['superior'];
                $add_user = $conn->prepare("INSERT INTO users (`id`, `type`, `superior`, `username`, `password`, `register_time`, `hwid`, `last_change`) VALUES (?,?,?,?,?,?,?,?)");
                $add_user->execute([0, $type, $superior, $username, password_hash($password, PASSWORD_DEFAULT), time(), "", 0]);
                header("Location: ../login.php?error=注册成功,请登录");
            } else {
                header($header . "密钥不存在");
            }
        } else {
            header($header . "用户名已经存在");
        }
    }
}
