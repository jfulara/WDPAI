<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/styles/style.css" rel="stylesheet">
    <link href="public/styles/security.css" type="text/css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lily Script One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Calistoga' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/8fd9367667.js" crossorigin="anonymous"></script>
    <script src="public/scripts/nav.js" defer></script>
    <script type="text/javascript" src="public/scripts/script.js" defer></script>
    <title>Register</title>
</head>
<body>
<main>
    <div class="login-container">
        <div class="logo-side">
            <div class="logo">
                <p>
                    Fineance
                </p>
            </div>
            <div class="description">
                <h2>
                    Utwórz konto:
                </h2>
            </div>
        </div>
        <div class="form-side">
            <form class="register" action="/register" method="POST">
                <div class="messages">
                    <?php if(isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input name="username" type="text" placeholder="username">
                <input name="email" type="text" placeholder="email@email.com">
                <input name="password" type="password" placeholder="password">
                <input name="confirmPassword" type="password" placeholder="confirm password">
                <button type="submit">SIGN UP</button>
            </form>
        </div>
    </div>
</main>
</body>
</html>