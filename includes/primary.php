<?php
session_start();
function sidebar($text)
{
    echo ('
    <!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">HUMAN<sup>menu</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item ' . ($text == "index" ? "active" : "") . '">
    <a class="nav-link" href="./index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>控制台</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    账户
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item '.(($text =="account-info"||$text =="account-upgrade")? "active" : "").'">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>个人中心</span>
    </a>
    <div id="collapseTwo" class="collapse '.(($text =="account-info"||$text =="account-upgrade")? "show" : "").'" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">个人中心:</h6>
            <a class="collapse-item '.($text =="account-info"? "active" : "").'" href="./account-info.php">账户资料</a>
            <a class="collapse-item '.($text =="account-upgrade"? "active" : "").'" href="./account-upgrade.php">账户升级</a>
        </div>
    </div>
</li>'
.

($_SESSION['user_type']>0?'<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item '.(($text =="user-manage"||$text =="key-manage")? "active" : "").'">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>下级管理</span>
    </a>
    <div id="collapseUtilities" class="collapse '.(($text =="user-manage"||$text =="key-manage")? "show" : "").'" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">下级管理:</h6>
            <a class="collapse-item '.($text =="user-manage"? "active" : "").'" href="./user-manage.php">用户管理</a>
            <a class="collapse-item '.($text =="key-manage"? "active" : "").'" href="./key-manage.php">密钥管理</a>
        </div>
    </div>
</li>':"")
.
'<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    资源中心
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item '.($text=="download"?"active":"").'">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>下载</span>
    </a>
    <div id="collapsePages" class="collapse '.(($text =="download")? "show" : "").'" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">下载:</h6>
            <a class="collapse-item '.($text=="download"?"active":"").'" href="./download.php">下载菜单</a>
        </div>
    </div>
</li>

<!-- Nav Item - Charts -->
<li class="nav-item '.($text=="help"?"active":"").'">
    <a class="nav-link" href="./help.php">
        <i class="fas fa-fw fa-hands-helping"></i>
        <span>帮助</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->
<div class="sidebar-card d-none d-lg-flex">
    <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
    <p class="text-center mb-2"><strong>HUMAN</strong>官方群 </p>
    <a class="btn btn-success btn-sm" href="https://jq.qq.com/?_wv=1027&k=yrYoSHtx">加入群聊</a>
</div>

</ul>
<!-- End of Sidebar -->
    
    ');
}
function topbar()
{
    echo ('<!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

        <!-- Nav Item -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#">
                <i class="fab fa-discord"></i>
            </a>
        </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">' . $_SESSION['user_username'] . '</span>
                    <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="./account-info.php">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        账户设置
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        退出登录
                    </a>
                </div>
            </li>

        </ul>

    </nav>
    <!-- End of Topbar -->');
}

function Footer()
{
    echo ('<!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; HUMAN 2022</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->'
        .
        '<!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">准备离开?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">如果您准备好结束当前会话，请选择下面的"退出".</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">取消</button>
                        <a class="btn btn-primary" href="./php/logout.php">退出</a>
                    </div>
                </div>
            </div>
        </div>'
    );
}
