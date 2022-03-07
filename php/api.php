<?php
session_start();
include 'db_conn.php';
include 'util/encrypt.php';
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['hwid'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hwid = $_POST['hwid'];
    if (empty($username)) {
        $ret = ["code" => 1, "msg" => "用户名为空", "time" => time()];
    } else if (empty($password)) {
        $ret = ["code" => 1, "msg" => "密码为空", "time" => time()];
    } else if (empty($hwid)) {
        $ret = ["code" => 1, "msg" => "HIWD为空", "time" => time()];
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->execute([$username]);

        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch();

            $user_id = $user['id'];
            $user_username = $user['username'];
            $user_password = $user['password'];
            $user_hwid = $user['hwid'];

            if ($username === $user_username && password_verify($password, $user_password)) {
                if ($user_hwid == "") {
                    $stmt = $conn->prepare("UPDATE `users` SET `hwid`=? WHERE id=?");
                    $stmt->execute([$hwid, $user_id]);
                    $ret = ["code" => 0, "msg" => "已重新绑定新的HWID", "time" => time()];
                } else {
                    //返回带着数据库中的HWID供本地验证
                    $ret = ["code" => 0, "msg" => "登录成功", "hwid" => $user_hwid, "time" => time()];
                }
            } else {
                $ret = ["code" => 1, "msg" => "用户名或密码错误", "time" => time()];
            }
        } else {
            $ret = ["code" => 1, "msg" => "账户不存在", "time" => time()];
        }
    }
    $aesr = new Aes;
    return $aesr->encode(json_encode($ret, JSON_UNESCAPED_UNICODE));
}
