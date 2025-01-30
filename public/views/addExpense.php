<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/styles/style.css" type="text/css" rel="stylesheet">
    <link href="public/styles/expenses.css" type="text/css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lily Script One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Calistoga' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/8fd9367667.js" crossorigin="anonymous"></script>
    <script src="public/scripts/nav.js" defer></script>
    <title>Document</title>
</head>
<body>
    <nav>
        <div class="logo">
            <p>
                Fineance
            </p>
        </div>
        <ul class="active">
            <li class="first">Podsumowanie<i class="fa-solid fa-chevron-right"></i></li>
            <li>Analiza budżetu<i class="fa-solid fa-chevron-right"></i></li>
            <li>Cele miesięczne<i class="fa-solid fa-chevron-right"></i></li>
            <li>Historia wydatków<i class="fa-solid fa-chevron-right"></i></li>
            <li>Statystyki<i class="fa-solid fa-chevron-right"></i></li>
            <li>Oszczędzanie<i class="fa-solid fa-chevron-right"></i></li>
        </ul>
        <div class="buttons">
            <button class="technical-help">
                Pomoc techniczna
            </button>
            <button class="settings">
                <i class="fa-solid fa-gear"></i>Ustawienia
            </button>
        </div>
       
        <ul class="mobile-icons">
            <i class="fa-solid fa-bars"></i>
        </ul>
    </nav>
    <main>
        <section class="expense-form">
            <h1>UPLOAD</h1>
            <form action="/addExpense" method="POST" enctype="multipart/form-data">
                <div class="messages">
                    <?php if(isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input name="title" type="text" placeholder="title">
                <input name="amount" type="number" step="0.01" min="0.00" placeholder="amount">
                <input name="date" type="date" placeholder="date">
                <input name="category" type="text" placeholder="category">
                <button type="submit">SEND</button>
            </form>
        </section>
    </main>
</body>
</html>