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

	const expenseCtx = document.getElementById('expenseChart').getContext('2d');
    const incomeCtx = document.getElementById('incomeChart').getContext('2d');




	 try {
        const financialData = await fetchFinancialData();
        const expenseLabels = financialData.expenses.map(item => item.category_name);
        const expenseValues = financialData.expenses.map(item => item.total_expenditure);
        const incomeLabels = financialData.incomes.map(item => item.category_name);
        const incomeValues = financialData.incomes.map(item => item.total_income);

        renderChart(expenseCtx, expenseLabels, expenseValues, 'Expenses by Category');
        renderChart(incomeCtx, incomeLabels, incomeValues, 'Income by Category');

        displayFinancialInfo(financialData.expenses, financialData.incomes);
    } catch (error) {
        console.error('Failed to load financial data:', error);
    }
	


});

async function fetchFinancialData() {
    const response = await fetch('dashboard-handler.php');
    const data = await response.json();
    return data;
}

function renderChart(ctx, labels, values, title) {
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: title,
                data: values,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: title
                }
            }
        },
    });
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
 
	const totalExpenses = calculateTotal(expenses, 'total_expenditure');
	const totalIncomes = calculateTotal(incomes, 'total_income');	

	const netIncome = totalIncomes - totalExpenses;
    if (totalIncomes) {
    savingsRate = ((netIncome / totalIncomes) * 100).toFixed(2);
	} else {
		savingsRate = 0;
	}
	
	const totalSavings = netIncome; 

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

   }


function calculateTotal(data, key) {
	let total = 0;
    for (let i = 0; i < data.length; i++) {
        total += parseFloat(data[i][key]);
    }
	return total; 
}

// Function to calculate savings rate
function calculateSavingsRate(netIncome, totalIncomes) {
    return totalIncomes ? ((netIncome / totalIncomes) * 100).toFixed(2) : 0;
}

// Function to update financial display
function updateFinancialDisplay(netIncome, savingsRate, totalSavings) {
    document.getElementById('net-income').textContent = `$${formatCurrency(netIncome)}`;
    document.getElementById('savings-rate').textContent = `${savingsRate}%`;
    document.getElementById('total-savings').textContent = `$${formatCurrency(totalSavings)}`;
}

// Function to format number to currency
function formatCurrency(amount) {
	


    return parseFloat(amount).toFixed(2);
}

// Function to populate breakdown list
function populateBreakdown(element, data, key) {
    data.forEach(item => {
        const li = document.createElement('li');
        li.textContent = `${item.category_name}: $${formatCurrency(item[key])}`;
        element.appendChild(li);
    });
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


