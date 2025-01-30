const search = document.querySelector('input[placeholder="Znajdź wydatek"]');
const expenseContainer = document.querySelector('section[class="expenses"]');

search.addEventListener('keyup', function(event) {
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

function loadExpenses(expenses) {
    expenses.forEach(expense => {
        console.log(expense);
        createExpense(expense);
    });
}

function createExpense(expense) {
    const template = document.querySelector('#expense-template');

    const clone = template.content.cloneNode(true);

    const title = clone.querySelector('h2');
    title.innerHTML = expense.title;
    const amount = clone.querySelector('h1');
    amount.innerHTML = expense.amount;
    const category = clone.querySelector('p.category');
    category.innerHTML = expense.category;
    const date = clone.querySelector('p.date');
    date.innerHTML = expense.date;

    expenseContainer.appendChild(clone);
}