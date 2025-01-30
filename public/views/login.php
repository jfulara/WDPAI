<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/styles/style.css" rel="stylesheet">
    <link href="public/styles/security.css" type="text/css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lily Script One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Calistoga' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Average Sans' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/8fd9367667.js" crossorigin="anonymous"></script>
    <script src="public/scripts/nav.js" defer></script>
    <title>Document</title>
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
                    <p class="main-description">
                       Dzień dobry!
                    </p>
                    <p class="additional-description">
                        Zaloguj się lub utwórz nowe konto:
                    </p>
                </div>
            </div>
            <div class="form-side">
                <form class="login" action="/login" method="POST">
                    <div class="messages">
                        <?php
                        if(isset($messages)) {
                            foreach ($messages as $message) {
                                echo '<p class="error">' . $message . '</p>';
                            }
                        }
                        if(isset($confirmations)) {
                            foreach ($confirmations as $confirmation) {
                                echo '<p class="confirmation">' . $confirmation . '</p>';
                            }
                        }
                        ?>
                    </div>
                    <input name="email" type="text" placeholder="E-mail">
                    <input name="password" type="password" placeholder="Hasło">
                    <div class="button-background">
                        <button class="special-button" type="submit">Zaloguj się</button>
                    </div>
                    <div class="register-link">
                        <p>Nie masz jeszcze konta?&nbsp;</p>
                        <a href="register">Utwórz je tutaj!</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>