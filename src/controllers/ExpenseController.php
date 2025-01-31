<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Expense.php';
require_once __DIR__.'/../repository/ExpenseRepository.php';

class ExpenseController extends AppController{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $messages = [];
    private $expenseRepository;

    public function __construct() {
        $this->expenseRepository = new ExpenseRepository();
    }

    public function expenses() {
        require_once 'session_config.php';

        if (!isset($_SESSION['user_id'])) {
            return $this->render('login');
        }

        $expenses = $this->expenseRepository->getExpenses();
        $this->render("expenses", ['expenses' => $expenses]);
    }

    public function addExpense(){
        require_once 'session_config.php';

        if (!isset($_SESSION['user_id'])) {
            return $this->render('login');
        }

        if ($this->isPost()) {
            //move_uploaded_file($_FILES['file']['tmp_name'], dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']);

            $expense = new Expense($_POST['title'], $_POST['amount'], $_POST['date'], $_POST['category']);
            $this->expenseRepository->addExpense($expense);

            return $this->render('expenses', ['messages' => $this->messages, 'expenses' => $this->expenseRepository->getExpenses()]);
        }
        return $this->render('addExpense', ['messages' => $this->messages]);
    }

    public function searchExpense() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->expenseRepository->getExpensesByTitle($decoded["search"]));
        }
    }

    private function validate(array $file): bool {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'File is too big!';
            return false;
        }

        if (!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'File type is not allowed!';
            return false;
        }

        return true;
    }
}