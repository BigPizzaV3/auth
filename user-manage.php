<?php
include './php/db_conn.php';
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

        <title>HUMAN - 用户管理</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <!-- Custom styles for this page -->
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">
            <?php

            include "./includes/primary.php";
            sidebar("user-manage");
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
                        <h1 class="h3 mb-2 text-gray-800">用户管理</h1>
                        <p class="mb-4">在这里管理你的用户.</p>

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">用户列表</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>类型</th>
                                                <th>上级</th>
                                                <th>用户名</th>
                                                <th>注册时间</th>
                                                <th>最后换绑时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>类型</th>
                                                <th>上级</th>
                                                <th>用户名</th>
                                                <th>注册时间</th>
                                                <th>最后换绑时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->prepare("SELECT * FROM users WHERE superior=?");
                                            $stmt->execute([$_SESSION['user_id']]);
                                            for ($i = 0; $i < $stmt->rowCount(); $i++) {
                                                $user = $stmt->fetch();
                                                echo ("<tr>");
                                                echo ("<td>" . $user['id'] . "</td>");
                                                echo ("<td>" . $user['type'] . "</td>");
                                                echo ("<td>" . $user['superior'] . "</td>");
                                                echo ("<td>" . $user['username'] . "</td>");
                                                echo ("<td>" . date('Y-m-d|H:i:s', $user['register_time']) . "</td>");
                                                echo ("<td>" . ($user['last_change'] != 0 ? date('Y-m-d|H:i:s', $user['last_change']) : "从未换绑过") . "</td>");
                                                echo ("<td><button class='btn btn-primary' type='button' onclick='resetPassword(" . $user['id'] . ")'>重置密码</button> ");
                                                echo ("<button class='btn btn-primary' type='button' onclick='rmuser(" . $user['id'] . ")'>删除</button></td>");
                                                echo ("</tr>");
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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

        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable();
            });
        </script>
        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
        <script>
            function resetPassword($id) {
                if (confirm("您真的确定要重置吗?\n\n???")) {
                    $.ajax({
                        url: './php/adminapi.php',
                        type: "post",
                        data: {
                            type: 'reset_password',
                            id: $id
                        },
                        dataType: "json",
                        success: function(data, textStatus) {
                            alert(data.msg)
                        }
                    });
                }
            }
        </script>
        <script>
            function rmuser($id) {
                if (confirm("您真的确定要删除吗?\n\n???")) {
                    $.ajax({
                        url: './php/adminapi.php',
                        type: "post",
                        data: {
                            type: 'rmuser',
                            id: $id
                        },
                        dataType: "json",
                        success: function(data, textStatus) {
                            location.reload();
                        }
                    });
                }
            }
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: login.php");
}
?>