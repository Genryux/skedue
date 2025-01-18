<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        
    <?php

        use Core\Session;

        if ($errors ?? false) {
            var_dump($errors);
        }
    ?>

    <?php if (!isset($_SESSION['user'])): ?>

        <a href="/register">Register here!</a>
        <h1>Login</h1>
        <form action="/login" method="POST">
            <input type="email" name="email" placeholder="email" value="<?= old('email') ?>">
            <input type="password" name="password" placeholder="password">
            <button>Login</button>
        </form>
    <?php else: ?>
        <h1>Welcome <?= $_SESSION['user']['email']?></h1>
        <form action="/logout" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <button>Logout</button>
        </form>
    <?php endif; ?>
</body>
</html>