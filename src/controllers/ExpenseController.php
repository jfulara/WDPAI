<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Expense.php';


class ExpenseController extends AppController{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $messages = [];

    public function addExpense(){
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file($_FILES['file']['tmp_name'], dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']);

            $expense = new Expense($_POST['title'], $_POST['amount'], $_POST['date'], $_POST['category'], $_FILES['file']['name']);

            return $this->render('dashboard', ['messages' => $this->messages, 'expense' => $expense]);
        }
        $this->render('addExpense', ['messages' => $this->messages]);
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