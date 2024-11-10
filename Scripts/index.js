document.addEventListener("DOMContentLoaded", () => {
    let transactions = [];
    const transactionForm = document.getElementById("transaction-form");
    const transactionList = document.getElementById("transaction-list");
    const totalBudget = document.getElementById("total-budget");

    function updateBudget() {
        const total = transactions.reduce((acc, transaction) => {
            return transaction.type === "income"
                ? acc + transaction.amount
                : acc - transaction.amount;
        }, 0);
        totalBudget.textContent = `$${total.toFixed(2)}`;
    }

    function renderTransactions(transactionsToRender) {
        transactionList.innerHTML = "";
        transactionsToRender.forEach((transaction, index) => {
            const li = document.createElement("li");
            li.innerHTML = `
                <span>${transaction.date} - ${transaction.note} - $${transaction.amount.toFixed(2)} (${transaction.type})</span>
                <button onclick="deleteTransaction(${index})">Delete</button>
            `;
            transactionList.appendChild(li);
        });
        updateBudget();
    }

    transactionForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const note = document.getElementById("note").value;
        const amount = parseFloat(document.getElementById("amount").value);
        const type = document.getElementById("type").value;
        const date = document.getElementById("date").value;

        const transaction = { note, amount, type, date };
        transactions.push(transaction);

        renderTransactions(transactions);
        transactionForm.reset();
    });

    window.deleteTransaction = function (index) {
        transactions.splice(index, 1);
        renderTransactions(transactions);
    };

    document.getElementById("apply-filters").addEventListener("click", () => {
        const minPrice = parseFloat(document.getElementById("min-price").value) || 0;
        const maxPrice = parseFloat(document.getElementById("max-price").value) || Infinity;
        const type = document.getElementById("filter-type").value;
        const date = document.getElementById("filter-date").value;
        const note = document.getElementById("filter-note").value.toLowerCase();

        const filteredTransactions = transactions.filter(transaction => {
            const matchesType = type === "all" || transaction.type === type;
            const matchesAmount = transaction.amount >= minPrice && transaction.amount <= maxPrice;
            const matchesDate = !date || transaction.date === date;
            const matchesNote = !note || transaction.note.toLowerCase().includes(note);
            return matchesType && matchesAmount && matchesDate && matchesNote;
        });

        renderTransactions(filteredTransactions);
    });
});