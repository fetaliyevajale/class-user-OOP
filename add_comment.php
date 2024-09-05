<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şərh Əlavə Et</title>
</head>
<body>

<h1>Şərh Əlavə Et</h1>

<form action="Comment.php" method="post">
    <input type="hidden" name="blog_id" value="<?php echo htmlspecialchars($_GET['blog_id']); ?>">
    <textarea name="content" rows="4" cols="50" placeholder="Şərhinizi daxil edin..."></textarea>
    <button type="submit">Şərh əlavə et</button>
</form>

</body>
</html>
