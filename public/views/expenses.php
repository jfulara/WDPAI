<?php
require_once 'session_config.php';

function outputUserName() {
    if (isset($_SESSION['user_id'])) {
        echo 'Witaj ' . $_SESSION['user_name'] . '!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/styles/style.css" type="text/css" rel="stylesheet">
    <link href="public/styles/expenses.css" type="text/css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lily Script One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Calistoga' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Average Sans' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/8fd9367667.js" crossorigin="anonymous"></script>
    <script src="public/scripts/nav.js" defer></script>
    <script src="public/scripts/search.js" defer></script>
    <title>Document</title>
</head>
<body>
    <nav class="menu">
        <div class="logo">
            <p>
                Fineance
            </p>
        </div>
        <div class="welcome-string">
            <p>
                <?php
                outputUserName();
                ?>
            </p>
        </div>
        <ul class="active">
            <li><a class="first" href="dashboard">Podsumowanie<i class="fa-solid fa-chevron-right"></i></a></li>
            <li><a>Analiza budżetu<i class="fa-solid fa-chevron-right"></i></a></li>
            <li><a>Cele miesięczne<i class="fa-solid fa-chevron-right"></i></a></li>
            <li><a class="active">Historia wydatków<i class="fa-solid fa-chevron-right"></i></a></li>
            <li><a>Statystyki<i class="fa-solid fa-chevron-right"></i></a></li>
            <li><a>Oszczędzanie<i class="fa-solid fa-chevron-right"></i></a></li>
        </ul>
        <div class="buttons">
            <button class="technical-help">
                Pomoc techniczna
            </button>
            <button class="settings">
                <i class="fa-solid fa-gear"></i>Ustawienia
            </button>
            <form class="logout" action="/logout" method="post">
                <button class="logout" type="submit">Wyloguj się</button>
            </form>
        </div>
        <ul class="mobile-icons">
            <i class="fa-solid fa-bars"></i>
        </ul>
    </nav>
    <nav class="adder">
        <ul class="adder-list">
            <li class="adder-item">
                <a href="addIncome" class="adder-link">
                    <i class="fa-solid fa-circle-plus"></i>
                    <span class="link-text">&nbsp;&nbsp;&nbsp;&nbsp;Dodaj wpływ</span>
                </a>
            </li>
            <li class="adder-item">
                <a href="addExpense" class="adder-link">
                    <i class="fa-solid fa-circle-minus"></i>
                    <span class="link-text">&nbsp;&nbsp;&nbsp;&nbsp;Dodaj wydatek</span>
                </a>
            </li>
        </ul>
        <div class="plus">
            <i class="fa-solid fa-plus"></i>
        </div>
    </nav>
    <main>
        <h1>Historia wydatków</h1>
        <div class="search-bar">
            <input placeholder="Znajdź wydatek">
        </div>
        <div class="expenses">
            <section class="expenses">
                <?php foreach ($expenses as $expense): ?>
                    <div class="expense">
                        <div>
                            <h2><?= $expense->getTitle(); ?></h2>
                            <h1><?= $expense->getAmount(); ?> zł</h1>
                            <p><?= $expense->getCategory(); ?></p>
                            <p><?= $expense->getDate(); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </section>
        </div>
    </main>
</body>
</html>

<template id="expense-template">
    <div class="expense">
        <div>
            <h2>title</h2>
            <h1>amount zł</h1>
            <p class="category">category</p>
            <p class="date">date</p>
        </div>
    </div>
</template>