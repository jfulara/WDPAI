const searchExpenses = document.querySelector('input[placeholder="Znajdź wydatek"]');
const searchIncomes = document.querySelector('input[placeholder="Znajdź wpływ"]');
const expenseContainer = document.querySelector('ul[class="expense-list"]');
const incomeContainer = document.querySelector('ul[class="income-list"]');

searchExpenses.addEventListener('keyup', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();

        const data = {search: this.value};

        fetch("/searchExpense", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function(response) {
            return response.json();
        }).then(function(expenses) {
            expenseContainer.innerHTML = '';
            loadExpenses(expenses);
        })
    }
});

searchIncomes.addEventListener('keyup', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();

        const data = {search: this.value};

        fetch("/searchIncome", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function(response) {
            return response.json();
        }).then(function(incomes) {
            incomeContainer.innerHTML = '';
            loadIncomes(incomes);
        })
    }
});

function loadExpenses(expenses) {
    createExpenseHeading();
    expenses.forEach(expense => {
        console.log(expense);
        createExpense(expense);
    });
}

function loadIncomes(incomes) {
    createIncomeHeading();
    incomes.forEach(income => {
        console.log(income);
        createIncome(income);
    });
}

function createExpenseHeading() {
    const template = document.querySelector('#expense-heading-template');

    const clone = template.content.cloneNode(true);

    expenseContainer.appendChild(clone);
}

function createIncomeHeading() {
    const template = document.querySelector('#income-heading-template');

    const clone = template.content.cloneNode(true);

    incomeContainer.appendChild(clone);
}

function createExpense(expense) {
    const template = document.querySelector('#expense-template');

    const clone = template.content.cloneNode(true);

    const date = clone.querySelector('h1.date');
    date.innerHTML = expense.date;
    const title = clone.querySelector('h1.title');
    title.innerHTML = expense.title;
    const category = clone.querySelector('p.category');
    category.innerHTML = expense.category;
    const amount = clone.querySelector('h2.amount');
    amount.innerHTML = expense.amount;

    expenseContainer.appendChild(clone);
}

function createIncome(income) {
    const template = document.querySelector('#income-template');

    const clone = template.content.cloneNode(true);

    const date = clone.querySelector('h1.date');
    date.innerHTML = income.date;
    const title = clone.querySelector('h1.title');
    title.innerHTML = income.title;
    const category = clone.querySelector('p.category');
    category.innerHTML = income.category;
    const amount = clone.querySelector('h2.amount');
    amount.innerHTML = income.amount;

    incomeContainer.appendChild(clone);
}