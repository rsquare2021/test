<?php session_start(); ?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>ログアウト</title>
</head>
<body class="form">
<?php $_SESSION = array(); ?>
<script>
    window.location.href = "./auth_login.php";
</script>
</body>
</html>
