// definitions for global scope vars
// globally define some object that i can use like a map for k-v pairs for my sess data
let sess_map;

// function for retrieving session variables via ajax from get-session-data.php

async function getSessionData() {
    const data_path = 'utils/get-session-data.php';
    const response = await fetch(data_path);
    const data = await response.json();
    return data;
}


	document.addEventListener('DOMContentLoaded', async function() {
    let content = document.getElementById('dashboard');
    let root_filepath = content.getAttribute('root_path');
    let curr_page = window.location.pathname;
    let root = '/cs2450/';
    sess_map = await getSessionData();

    console.log(curr_page);
    loadDashboard(content);
});

async function fetchFinancialData() {
    const response = await fetch('dashboard-handler.php');
    const data = await response.json();
    return data;
}

async function loadDashboard(content) {
    if (content) {
        // Init session variables as null until we can confirm they exist
        let logged_in = null;
        let username = null;
        let user_id = null;
        // Check to see if logged_in is even present in the sess_map
        if ('logged_in' in sess_map) {
            logged_in = sess_map.logged_in;
        }
        // if it is present, and it is true...
        if (logged_in) {
            username = sess_map.username;
            user_id = sess_map.user_id;
            content.innerHTML =`
                    <div id="dashboard__header">
                        <h2 id="welcome__message">Welcome back, ${username}</h2>
                    </div>
                    <div id="dashboard__synopsis">
                        <p>Overview of your financial plan</p>
                    </div>
                    <div id="dashboard__graphic">
                        <img src="/cs2450/design/dash_banner.png" class="dashboard__banner" alt="Dashboard Banner">
                    </div>
                    <div id="charts-container">
                        <div class="chart">
                            <h3>Expenses by Category</h3>
                            <canvas id="expenseChart" width="200" height="200"></canvas>
                        </div>
                        <div class="chart">
                            <h3>Income by Category</h3>
                            <canvas id="incomeChart" width="200" height="200"></canvas>
                        </div>
                    </div>
            `;

            const financialData = await fetchFinancialData();
            if (financialData.status === 'success') {
                displayFinancialInfo(financialData.expenses, financialData.incomes);
            } else {
                console.error('Failed to load financial data:', financialData.message);
            }

        } else {
            content.innerHTML =`
                    <div id="dashboard__header">
                        <h2 id="welcome__message">Dashboard</h2>
                    </div>
                    <div id="dashboard__synopsis">
                        <p>To get started using BudgetBuddy, log in or create an account. </p>
                    </div>
                    <div id="dashboard__graphic">
                    </div>
            `;
        }
        addEventListeners(logged_in); // Pass logged_in to the function
    }
}

function displayFinancialInfo(expenses, incomes) {
    const totalExpenses = expenses.reduce((acc, item) => acc + parseFloat(item.total_expenditure), 0);
    const totalIncomes = incomes.reduce((acc, item) => acc + parseFloat(item.total_income), 0);
    const netIncome = totalIncomes - totalExpenses;
    const savingsRate = totalIncomes ? ((netIncome / totalIncomes) * 100).toFixed(2) : 0;
    const totalSavings = netIncome; // Simplified for demonstration purposes

    document.getElementById('net-income').textContent = `$${netIncome.toFixed(2)}`;
    document.getElementById('savings-rate').textContent = `${savingsRate}%`;
    document.getElementById('total-savings').textContent = `$${totalSavings.toFixed(2)}`;

    const expenseBreakdown = document.getElementById('expense-breakdown');
    expenses.forEach(expense => {
        const li = document.createElement('li');
        li.textContent = `${expense.category_name}: $${expense.total_expenditure}`;
        expenseBreakdown.appendChild(li);
    });

    const incomeBreakdown = document.getElementById('income-breakdown');
    incomes.forEach(income => {
        const li = document.createElement('li');
        li.textContent = `${income.category_name}: $${income.total_income}`;
        incomeBreakdown.appendChild(li);
    });

    const financialGoals = document.getElementById('financial-goals');
    const goalLi = document.createElement('li');
    goalLi.textContent = 'Example Goal: Save $5000 in 6 months';
    financialGoals.appendChild(goalLi);
}



function addEventListeners(logged_in) {
    const sitemap_button = document.getElementById('siteMapButton');
    if (sitemap_button) {
        console.log("sitemap button exists");

        sitemap_button.addEventListener('click', function() {
            window.location.href = 'design/sitemap.php';
        });
    }

    // If the page we are on is the dashboard, add event listeners to buttons in the dashboard
}


