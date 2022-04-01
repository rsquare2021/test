<?php
session_start();
if(empty($_SESSION['id'])) {
    header('Location:./auth_login.php');
    exit;
}
if($_SESSION['kengen'] != 1) {
    header('Location:./index.php');
    exit;
}


?>
<!DOCTYPE html>
<html lang="ja">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
<title>ユーザー追加</title>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="./css/style.css" rel="stylesheet" type="text/css" />
<link href="./css/bootstrap-toggle.min.css" rel="stylesheet" type="text/css" />
</html>
<body>
<div class="header-container">
        <header class="header navbar navbar-expand-sm">

            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <div class="nav-logo align-self-center">
            <a class="navbar-brand" href="/sales"><span class="navbar-brand-name">ユーザー管理</span></a>
            </div>

        </header>
    </div>

    <div id="content" class="main-content">
        
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <form onsubmit="return false;">
                            <div class="form-group">
                                <label for="exampleInputEmail1">新規作成</label>
                                <input type="text" class="form-control w-75" id="user_id" pattern="^[0-9A-Za-z]+$" placeholder="新規ユーザーのID(半角英数字)">
                            </div>
                            <button id="createBtn" type="submit" class="btn btn-primary">追加</button>
                        </form>
                        <div class="table-responsive mb-4 mt-4">
                            <table id="zero-config" class="table table-hover user_list" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>PASS</th>
                                        <th>有効</th>
                                    </tr>
                                </thead>
                                <tbody id="mk_tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/libs/jquery-3.1.1.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="./js/bootstrap-toggle.js"></script>
<script src="./js/ajax.js"></script>
<script src="./js/add_user.js"></script>

</body>
</html>