<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Operation.php';
class OperationRepository extends Repository
{
    public function getExpense(int $id): ?Operation {
        $stmt = $this->database->connect()->prepare("SELECT * FROM expenses WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $expense = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($expense == false) {
            return null;
        }

        return new Operation($expense['title'], $expense['amount'], $expense['date'], $expense['category']);
    }

    public function addExpense(Operation $expense): void {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO expenses (id_user, title, amount, date, category)
            VALUES (?, ?, ?, ?, ?)
        ');

        require_once 'session_config.php';

        $id_user = $_SESSION['user_id'];

        $stmt->execute([$id_user, $expense->getTitle(), $expense->getAmount(), $expense->getDate(), $expense->getCategory()]);
    }

    public function addIncome(Operation $income): void {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO incomes (id_user, title, amount, date, category)
            VALUES (?, ?, ?, ?, ?)
        ');

        require_once 'session_config.php';

        $id_user = $_SESSION['user_id'];

        $stmt->execute([$id_user, $income->getTitle(), $income->getAmount(), $income->getDate(), $income->getCategory()]);
    }

    public function getExpenses(): array {
        $result = [];

        $stmt = $this->database->connect()->prepare("SELECT * FROM expenses where id_user = :user_id");
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();
        $expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($expenses as $expense) {
            $result[] = new Operation($expense['title'], $expense['amount'], $expense['date'], $expense['category']);
        }

        return $result;
    }

    public function getIncomes(): array {
        $result = [];

        $stmt = $this->database->connect()->prepare("SELECT * FROM incomes where id_user = :user_id");
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();
        $incomes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($incomes as $income) {
            $result[] = new Operation($income['title'], $income['amount'], $income['date'], $income['category']);
        }

        return $result;
    }

    public function getExpensesByTitle(string $searchString): array {
        $searchString = '%'.strtolower($searchString).'%';

        require_once 'session_config.php';

        $id_user = $_SESSION['user_id'];

        $stmt = $this->database->connect()->prepare("SELECT * FROM expenses WHERE LOWER(title) LIKE :search AND id_user = :id_user");
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIncomesByTitle(string $searchString): array {
        $searchString = '%'.strtolower($searchString).'%';

        require_once 'session_config.php';

        $id_user = $_SESSION['user_id'];

        $stmt = $this->database->connect()->prepare("SELECT * FROM incomes WHERE LOWER(title) LIKE :search AND id_user = :id_user");
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIncomeToExpense(): array {
        $stmt = $this->database->connect()->prepare("SELECT (SELECT (SUM(amount)) FROM incomes
            WHERE id_user = :id_user AND EXTRACT(MONTH FROM incomes.date) = EXTRACT(MONTH FROM NOW()) AND EXTRACT(YEAR FROM incomes.date) = EXTRACT(YEAR FROM NOW())) -  
            (SELECT (SUM(amount)) FROM expenses 
            WHERE id_user = :id_user AND EXTRACT(MONTH FROM expenses.date) = EXTRACT(MONTH FROM NOW()) AND EXTRACT(YEAR FROM expenses.date) = EXTRACT(YEAR FROM NOW())) AS diff
         ");
        $stmt->bindParam(':id_user', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $intResult = $result["diff"];

        if ($intResult > 0) {
            $stringResult = '+' . $intResult;
            $color = '#22BE54';
        } else if ($intResult < 0) {
            $stringResult = $intResult;
            $color = '#FF0000';
        } else {
            $stringResult = $intResult;
            $color = 'black';
        }

        $resultArray = [
            'difference' => $stringResult,
            'color' => $color
        ];

        return  $resultArray;
    }

    public function getIncomeSum(): string {
        $stmt = $this->database->connect()->prepare("SELECT (SUM(amount)) FROM incomes 
                     WHERE id_user = :id_user AND EXTRACT(MONTH FROM incomes.date) = EXTRACT(MONTH FROM NOW()) AND EXTRACT(YEAR FROM incomes.date) = EXTRACT(YEAR FROM NOW())");
        $stmt->bindParam(':id_user', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result["sum"];
    }

    public function getExpenseSum(): string {
        $stmt = $this->database->connect()->prepare("SELECT (SUM(amount)) FROM expenses 
                     WHERE id_user = :id_user AND EXTRACT(MONTH FROM expenses.date) = EXTRACT(MONTH FROM NOW()) AND EXTRACT(YEAR FROM expenses.date) = EXTRACT(YEAR FROM NOW())");
        $stmt->bindParam(':id_user', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result["sum"];
    }
}