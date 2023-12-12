<html lang="en">
<head>
    <link rel="stylesheet" href="/app.css">
    <title>My Blog</title>
</head>
<body>
<article>
    <h1><?= $post->title; ?></h1>

    <div>
        <?= $post->body; ?>
    </div>
</article>
<a href="/">Go Back</a>
</body>
</html>
