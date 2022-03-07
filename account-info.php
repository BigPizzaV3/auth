<?php
session_start();
if (isset($_SESSION['user_id'])) {
?>
    <!DOCTYPE html>
    <html lang="zh">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>HUMAN - 账户资料</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">
            <?php

            include "./includes/primary.php";
            sidebar("account-info");
            ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">
                    <?php
                    topbar();
                    ?>

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-4 text-gray-800">账户资料</h1>

                        <div class="row">

                            <div class="col-lg-6">

                                <!-- Circle Buttons -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">账户信息</h6>
                                    </div>
                                    <div class="card-body">

                                        <div class="mb-3">
                                            <label class="form-label">用户名</label>
                                            <input type="text" class="form-control" value=<?php echo ($_SESSION['user_username']); ?> readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">HWID</label>
                                            <input type="text" class="form-control" value=<?php echo ($_SESSION['user_hwid'] == "" ? "未设置" : $_SESSION['user_hwid']); ?> readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">最后一次重置日期</label>
                                            <input type="text" class="form-control" value=<?php echo ($_SESSION['user_last_change'] == 0 ? "从未重置过" : date('Y-m-d|H:i:s', $_SESSION['user_last_change'])); ?> readonly>
                                        </div>
                                    </div>
                                </div>

                                <!-- Brand Buttons -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">HWID</h6>
                                    </div>
                                    <div class="card-body">

                                        <div class="mb-3">
                                            <label class="form-label">现在</label>
                                            <input type="text" class="form-control" value=<?php echo (time() - $_SESSION['user_last_change'] > 24 * 60 * 60 ? "可以重置" : "不可以重置,等到" . date('Y-m-d|H:i:s', $_SESSION['user_last_change'] + 24 * 60 * 60)); ?> readonly>
                                        </div>
                                        <a href="#" class="btn btn-facebook btn-block" id="reset"><i class="fas fa-redo fa-fw"></i>重置</a>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6">

                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">修改密码</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">密码</label>
                                            <input type="password" class="form-control" id="password">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">密钥</label>
                                            <input type="text" class="form-control" id="key">
                                        </div>
                                        <a href="#" class="btn btn-facebook btn-block" id="save"><i class="fas fa-save fa-fw"></i>保存</a>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <?php
                Footer();
                ?>

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
        <script>
            $("#save").click(function() {
                $password = $("#password").val();
                $key = $("#key").val();
                $.ajax({
                    url: './php/account-info.php',
                    type: "post",
                    data: {
                        password: $password,
                        key: $key
                    },
                    dataType: "json",
                    success: function(data, textStatus) {
                        alert(data.msg);
                        if (data.code == 0) {
                            location = './php/logout.php';
                        }
                    }
                });
            });
        </script>
        <script>
            $("#reset").click(function() {
                $.ajax({
                    url: './php/reset-hwid.php',
                    type: "post",
                    dataType: "json",
                    success: function(data, textStatus) {
                        alert(data.msg);
                    }
                });
            });
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: login.php");
}
?>