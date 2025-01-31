<?php
require_once "session_config.php";
function checkSignupErrors() {
    if (isset($_SESSION['signup_errors'])) {
        $errors = $_SESSION['signup_errors'];

        foreach ($errors as $error) {
            echo '<p class="error">' . $error . '</p>';
        }
    }
}

function signupInputs() {
    if (isset($_SESSION['signup_data']['name'])) {
        echo '<input name="name" type="text" placeholder="Imię" value="' . $_SESSION['signup_data']['name'] . '">';
    } else {
        echo '<input name="name" type="text" placeholder="Imię">';
    }

    if (isset($_SESSION['signup_data']['surname'])) {
        echo '<input name="surname" type="text" placeholder="Nazwisko" value="' . $_SESSION['signup_data']['surname'] . '">';
    } else {
        echo '<input name="surname" type="text" placeholder="Nazwisko">';
    }

    if (isset($_SESSION['signup_data']['email']) && !isset($_SESSION['signup_errors']['email_used']) && !isset($_SESSION['signup_errors']['invalid_email'])) {
        echo '<input name="email" type="text" placeholder="E-mail" value="' . $_SESSION['signup_data']['email'] . '">';
    } else {
        echo '<input name="email" type="text" placeholder="E-mail">';
    }

    echo '<input name="password" type="password" placeholder="Hasło">';
    echo '<input name="confirmPassword" type="password" placeholder="Potwierdź hasło">';

    if (isset($_SESSION['signup_errors'])) {
        unset($_SESSION['signup_errors']);
    }

    if (isset($_SESSION['signup_data'])) {
        unset($_SESSION['signup_data']);
    }
}
?>

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
                    <p class="additional-description">
                        Utwórz konto:
                    </p>
                </div>
                <div class="login-link">
                    <p>Masz już konto?&nbsp;</p>
                    <a href="login">Przejdź do logowania!</a>
                </div>
            </div>
            <div class="form-side">
                <form class="register" action="/register" method="POST">
                    <div class="messages">
                        <?php
                        checkSignupErrors();
                        ?>
                    </div>
                    <?php
                    signupInputs();
                    ?>
                    <div class="button-background">
                        <button class="special-button" type="submit">Zarejestruj się</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>