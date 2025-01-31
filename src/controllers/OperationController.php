<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Operation.php';
require_once __DIR__ . '/../repository/OperationRepository.php';

class OperationController extends AppController{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $messages = [];
    private $operationRepository;

    public function __construct() {
        $this->operationRepository = new OperationRepository();
    }

    public function operations() {
        require_once 'session_config.php';

        if (!isset($_SESSION['user_id'])) {
            return $this->render('login');
        }

        $expenses = $this->operationRepository->getExpenses();
        $incomes = $this->operationRepository->getIncomes();
        return $this->render("operations", ['expenses' => $expenses, 'incomes' => $incomes]);
    }

    public function addExpense(){
        require_once 'session_config.php';

        if (!isset($_SESSION['user_id'])) {
            return $this->render('login');
        }

        if ($this->isPost()) {
            //move_uploaded_file($_FILES['file']['tmp_name'], dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']);

            $expense = new Operation($_POST['title'], $_POST['amount'], $_POST['date'], $_POST['category']);
            $this->operationRepository->addExpense($expense);

            $expenses = $this->operationRepository->getExpenses();
            $incomes = $this->operationRepository->getIncomes();

            header("Location: operations");
            die();

            /*return $this->render('operations', ['expenses' => $expenses, 'incomes' => $incomes]);*/
        }
        return $this->render('addExpense', ['messages' => $this->messages]);
    }

    public function addIncome(){
        require_once 'session_config.php';

        if (!isset($_SESSION['user_id'])) {
            return $this->render('login');
        }

        if ($this->isPost()) {
            //move_uploaded_file($_FILES['file']['tmp_name'], dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']);

            $income = new Operation($_POST['title'], $_POST['amount'], $_POST['date'], $_POST['category']);
            $this->operationRepository->addIncome($income);

            $expenses = $this->operationRepository->getExpenses();
            $incomes = $this->operationRepository->getIncomes();

            header("Location: operations");
            die();

            /*return $this->render('operations', ['expenses' => $expenses, 'incomes' => $incomes]);*/
        }
        return $this->render('addIncome', ['messages' => $this->messages]);
    }

    public function searchExpense() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->operationRepository->getExpensesByTitle($decoded["search"]));
        }
    }

    public function searchIncome() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->operationRepository->getIncomesByTitle($decoded["search"]));
        }
    }

    /*private function validate(array $file): bool {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'File is too big!';
            return false;
        }

        if (!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'File type is not allowed!';
            return false;
        }

        return true;
    }*/
}