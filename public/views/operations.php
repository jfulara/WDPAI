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
    <link href="public/styles/operations.css" type="text/css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lily Script One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Calistoga' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Average Sans' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/8fd9367667.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var userId = '<?php echo $_SESSION['user_id']; ?>';
    </script>
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
            <li><a class="active">Historia operacji<i class="fa-solid fa-chevron-right"></i></a></li>
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
    <main class="history">
        <section class="expenses-history">
            <h1>Historia wydatków</h1>
            <div class="search-bar">
                <input placeholder="Znajdź wydatek">
            </div>
            <div class="expenses">
                <section class="expenses">
                    <ul class="expense-list">
                        <li class="expense">
                            <h1 class="date-heading">Data</h1>
                            <h1 class="title-heading">Tytuł</h1>
                            <h1 class="category-heading">Kategoria</h1>
                            <h1 class="amount-heading">Kwota</h1>
                        </li>
                    <?php foreach ($expenses as $expense): ?>
                        <li class="expense">
                            <h1 class="date"><?= $expense->getDate(); ?></h1>
                            <h1 class="title"><?= $expense->getTitle(); ?></h1>
                            <p class="category"><?= $expense->getCategory(); ?></p>
                            <h2 class="amount"><?= $expense->getAmount(); ?> zł</h2>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </section>
            </div>
        </section>
        <section class="incomes-history">
            <h1>Historia wpływów</h1>
            <div class="search-bar">
                <input placeholder="Znajdź wpływ">
            </div>
            <div class="incomes">
                <section class="incomes">
                    <ul class="income-list">
                        <li class="income">
                            <h1 class="date-heading">Data</h1>
                            <h1 class="title-heading">Tytuł</h1>
                            <h1 class="category-heading">Kategoria</h1>
                            <h1 class="amount-heading">Kwota</h1>
                        </li>
                        <?php foreach ($incomes as $income): ?>
                        <li class="income">
                            <h1 class="date"><?= $income->getDate(); ?></h1>
                            <h1 class="title"><?= $income->getTitle(); ?></h1>
                            <p class="category"><?= $income->getCategory(); ?></p>
                            <h2 class="amount"><?= $income->getAmount(); ?> zł</h2>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </section>
            </div>
        </section>
    </main>
</body>
</html>

<template id="expense-heading-template">
    <li class="expense">
        <h1 class="date-heading">Data</h1>
        <h1 class="title-heading">Tytuł</h1>
        <h1 class="category-heading">Kategoria</h1>
        <h1 class="amount-heading">Kwota</h1>
    </li>
</template>

<template id="income-heading-template">
    <li class="income">
        <h1 class="date-heading">Data</h1>
        <h1 class="title-heading">Tytuł</h1>
        <h1 class="category-heading">Kategoria</h1>
        <h1 class="amount-heading">Kwota</h1>
    </li>
</template>

<template id="expense-template">
    <li class="expense">
        <h1 class="date"><?= $expense->getDate(); ?></h1>
        <h1 class="title"><?= $expense->getTitle(); ?></h1>
        <p class="category"><?= $expense->getCategory(); ?></p>
        <h2 class="amount"><?= $expense->getAmount(); ?> zł</h2>
    </li>
</template>

<template id="income-template">
    <li class="income">
        <h1 class="date"><?= $income->getDate(); ?></h1>
        <h1 class="title"><?= $income->getTitle(); ?></h1>
        <p class="category"><?= $income->getCategory(); ?></p>
        <h2 class="amount"><?= $income->getAmount(); ?> zł</h2>
    </li>
</template>