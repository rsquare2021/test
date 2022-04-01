<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Upload</title>
</head>

<body>
  <form enctype="multipart/form-data" action="/receipt/s3.php" method="POST">
    <input type="file" name="file">
    <input type="submit">
  </form>
</body>
</html>

