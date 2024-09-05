<?php
require_once 'QueryBuilder.php';
require_once 'Blog.php'; 


$db = QueryBuilder::connect();
$sql = "SELECT * FROM blogs";
$query = $db->prepare($sql);
$query->execute();
$blogs = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="az">
   

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloglar</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .comments {
            margin-top: 10px;
        }
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
}
h1 {
    text-align: center;
    margin: 20px;
    color: #333;
}
ul {
    list-style: none;
    padding: 0;
    margin: 0 auto;
    max-width: 800px;
}

li {
    background: #fff;
    margin-bottom: 20px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

li:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

h2 {
    margin-top: 0;
    color: #3498db;
}

p {
    line-height: 1.6;
}

.comments {
    margin-top: 20px;
    padding: 10px;
    border-top: 1px solid #ddd;
}

.comments h3 {
    margin: 0;
    color: #555;
}

.comments ul {
    padding-left: 20px;
}

.comments li {
    margin-bottom: 10px;
    padding: 10px;
    border-left: 3px solid #3498db;
    background: #f9f9f9;
    border-radius: 5px;
}
a {
    color: #3498db;
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

.edit-delete {
    margin-top: 10px;
}

.edit-delete a {
    color: #3498db;
    text-decoration: none;
    margin-right: 10px;
}

.edit-delete a:hover {
    text-decoration: underline;
}

button {
    background-color: #3498db;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    font-weight: bold;
}

button:hover {
    background-color: #2980b9;
}


.add-comment {
    display: inline-block;
    margin-top: 10px;
    background-color: #27ae60;
    color: #fff;
    padding: 10px 15px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
}

.add-comment:hover {
    background-color: #1e8449;
}


    </style>
</head>

<body>

    <h1>Bloglar</h1>

    <?php if (!empty($blogs)): ?>
        <ul>
            <?php foreach ($blogs as $blog): ?>
                <li>
                    <h2><?php echo htmlspecialchars($blog['title']); ?></h2>
                    <p><?php echo htmlspecialchars($blog['content']); ?></p>
                    <p>Əlavə olunma tarixi: <?php echo htmlspecialchars($blog['created_at']); ?></p>

                    <td>
                        <a href="edit_blog.php?id=<?php echo htmlspecialchars($blog['id']); ?>">Redaktə et</a> |
                        <a href="delete_blog.php?id=<?php echo htmlspecialchars($blog['id']); ?>" onclick="return confirm('Bu blogu silmək istəyirsinizmi?');">Sil</a>
                    </td>


                    <div class="comments">
                        <h3>Şərhlər:</h3>
                        <?php
                        $blogObj = new Blog($blog['id']);
                        $comments = $blogObj->getComments();
                        ?>
                        <?php if (!empty($comments)): ?>
                            <ul>
                                <?php foreach ($comments as $comment): ?>
                                    <li><?php echo htmlspecialchars($comment['content']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>Şərh yoxdur.</p>
                        <?php endif; ?>
                    </div>

                    <a href="add_comment.php?blog_id=<?php echo htmlspecialchars($blog['id']); ?>">Şərh əlavə et</a>
                    <a href="delete_comment.php?id=<?php echo htmlspecialchars($comment['id']); ?>" onclick="return confirm('Bu şərhi silmək istəyirsinizmi?');">Sil</a>

                    <br>
                  <br>
               

                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Blog mövcud deyil.</p>
    <?php endif; ?>

    <a  href="add_blog.php">Yeni Blog Əlavə Et</a>

</body>

</html>