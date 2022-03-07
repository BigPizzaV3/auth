<?php

//传入用户ID和数量,创建下级用户
// 返回成功失败
function get_randomstr($lenth = 32)
{
    $strs = "QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
    $name = substr(str_shuffle($strs), mt_rand(0, strlen($strs) - ($lenth + 1)), $lenth);
    return $name;
}

include './db_conn.php';
session_start();
if (isset($_SESSION['user_id'])) {
    //查询卡密数量
    $id = $_SESSION['user_id'];
    $user_Amount = 0;
    $createAumount = intval($_POST['createAmount']);
    $stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
    $stmt->execute([$id]);
    if ($stmt->rowCount() === 1) {
        $user = $stmt->fetch();
        $user_Amount = $user['amount'];
    }
    $ret = "";
    //如果数量足够
    if ($user_Amount >= $createAumount) {
        //更新数据库
        $stmt = $conn->prepare("UPDATE users SET amount=? WHERE id=?");
        $stmt->execute([$user_Amount - $createAumount, $id]);

        //更新显示
        $_SESSION['user_amount'] = $user_Amount - $createAumount;

        //创建卡密
        for ($i = 0; $i < $createAumount; $i++) {
            $stmt = $conn->prepare("INSERT INTO keytab (`id`, `type`, `superior`, `key_name`, `user`, `use_date`,`create_date`) VALUES (?,?,?,?,?,?,?)");
            $stmt->execute([0, 0, $id, get_randomstr(), "", 0, time()]);
            $ret = ["code" => 0, "msg" => "操作完成"];
        }
    } else {
        $ret = ["code" => 1, "msg" => "剩余数量不足"];
    }

    //返回前端
    echo (json_encode($ret, JSON_UNESCAPED_UNICODE));
}
