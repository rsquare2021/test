<?php
	session_start();
	if(isset($_SESSION['id']) && $_SESSION['id']) {
		header('Location: ./index.php');
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>ログイン | MEKEN </title>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/forms/switches.css">
    <link href="./css/style.css" rel="stylesheet" type="text/css" />
</head>
<body class="form">

    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">ログイン</h1>
                        <form class="text-left" onsubmit="return false;">
                            <div class="form">
                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="mail" name="mail" type="text" class="form-control" placeholder="ID">
                                </div>
                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" value="" placeholder="パスワード">
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <!-- <div class="field-wrapper toggle-pass">
                                        <p class="d-inline-block">パスワードを表示する</p>
                                        <label class="switch s-primary">
                                            <input type="checkbox" id="toggle-password" class="d-none">
                                            <span class="slider round"></span>
                                        </label>
                                    </div> -->
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" id="klik" value="">ログイン</button>
                                    </div>
                                </div>
								<!-- <div class="field-wrapper text-center keep-logged-in">
                                    <div class="n-chk new-checkbox checkbox-outline-primary">
                                        <label class="new-control new-checkbox checkbox-outline-primary">
                                          <input type="checkbox" class="new-control-input">
                                          <span class="new-control-indicator"></span>ログイン状態を保持する
                                        </label>
                                    </div>
                                </div>
                                <div class="field-wrapper">
                                    <a href="auth_pass_recovery.php" class="forgot-pass-link">パスワードを忘れた方はこちら</a>
                                </div> -->
                            </div>
                        </form>

                    </div>                    
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image">MEKEN</div>
        </div>
    </div>

    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="../assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- <script src="../assets/js/authentication/form-1.js"></script> -->
	<script src="./js/auth_login.js"></script>
	<script src="./js/ajax.js"></script>
</body>
</html>
