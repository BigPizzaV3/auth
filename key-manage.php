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

        <title>HUMAN - 卡密管理</title>

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
            sidebar("key-manage");
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
                        <h1 class="h3 mb-2 text-gray-800">密钥管理</h1>
                        <p class="mb-4">在这里管理你的密钥.</p>

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">管理</h6>
                            </div>
                            <div class="card-body">
                                <!-- createKey -->
                                <button class='btn btn-primary' type='button' data-toggle="modal" data-target="#createKey">创建密钥</button>
                            </div>
                        </div>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">密钥列表</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>类型</th>
                                                <th>上级</th>
                                                <th>密钥</th>
                                                <th>使用者</th>
                                                <th>使用日期</th>
                                                <th>创建日期</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>类型</th>
                                                <th>上级</th>
                                                <th>密钥</th>
                                                <th>使用者</th>
                                                <th>使用日期</th>
                                                <th>创建日期</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->prepare("SELECT * FROM keytab WHERE superior=?");
                                            $stmt->execute([$_SESSION['user_id']]);

                                            for ($i = 0; $i < $stmt->rowCount(); $i++) {
                                                $user = $stmt->fetch();
                                                echo ("<tr>");
                                                echo ("<td>" . $user['id'] . "</td>");
                                                echo ("<td>" . $user['type'] . "</td>");
                                                echo ("<td>" . $user['superior'] . "</td>");
                                                echo ("<td>" . $user['key_name'] . "</td>");
                                                echo ("<td>" . $user['user'] . "</td>");
                                                echo ("<td>" . ($user['use_date'] != 0 ? date('Y-m-d|H:i:s', $user['use_date']) : "未使用") . "</td>");
                                                echo ("<td>" . date('Y-m-d|H:i:s', $user['create_date']) . "</td>");
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




        <!-- Logout Modal-->
        <div class="modal fade" id="createKey" tabindex="-1" role="dialog" aria-labelledby="createKey" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createKey">创建密钥</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">剩余数量数量</label>
                            <input type="number" class="form-control" value=<?php echo ($_SESSION['user_amount']) ?> disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">创建数量</label>
                            <input type="number" class="form-control" id="createAmount" value="1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">取消</button>
                        <a class="btn btn-primary" id="create">创建</a>
                    </div>
                </div>
            </div>
        </div>


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

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable();
            });
        </script>

        <!-- create -->
        <script>
            $("#create").click(function() {
                $createAmount = $("#createAmount").val();
                $.ajax({
                    url: './php/creatre_key.php',
                    type: "post",
                    data: {
                        createAmount: $createAmount
                    },
                    dataType: "json",
                    success: function(data, textStatus) {
                        alert(data.msg);
                        if (data.code == 0) {
                            location.reload();
                        }
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