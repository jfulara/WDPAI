<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Expense.php';
class ExpenseRepository extends Repository
{
    public function getExpense(int $id): ?Expense {
        $stmt = $this->database->connect()->prepare("SELECT * FROM expenses WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $expense = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($expense == false) {
            return null;
        }

        return new Expense($expense['title'], $expense['amount'], $expense['date'], $expense['category']);
    }

    public function addExpense(Expense $expense): void {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO expenses (id_user, title, amount, date, category)
            VALUES (?, ?, ?, ?, ?)
        ');

        $id_user = 1;

        $stmt->execute([$id_user, $expense->getTitle(), $expense->getAmount(), $expense->getDate(), $expense->getCategory()]);
    }
}