<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>新規会員登録（ユーザー詳細） | MEKEN </title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
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

                        <h1 class="">パスワード接待</h1>
                        <p class="signup-link"><a href="auth_login.php">ログイン画面へ戻る</a></p>
                        <form class="text-left" onsubmit="return false;">
                            <div class="form">
                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" value="" placeholder="パスワード（8桁〜15桁半角英数）">
                                </div>
								
								<input type="hidden" value="<?= $_SESSION['mail']; ?>" name="mail" id="mail">
								<div class="field-wrapper mt-4">
									<a id="regist_complete" class="btn btn-primary" value="">会員登録を完了する</a>
								</div>

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
	<script src="./js/regist.js"></script>
	<script src="./js/ajax.js"></script>

</body>
</html>