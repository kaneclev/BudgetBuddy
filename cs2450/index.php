<?php
include('includes/top.php');
?>

<main>
        <div id="dashboard" root_path="/cs2450/">
            <div id="dashboard__header">
                <h2 id="welcome__message">Welcome back, ${username}</h2>
            </div>
            <div id="dashboard__synopsis">
                <h3>Overview of your financial plan</h3>
				<br>

			</div>
            <div id="dashboard__graphic">
                <img src="/cs2450/design/dash_banner.png" class="dashboard__banner" alt="Dashboard Banner">
            </div>
            <div id="charts-container">
                <div class="chart">
                    <h3>Expenses by Category</h3>
                    <canvas id="expenseChart" width="50" height="50"></canvas>
                </div>
                <div class="chart">
                    <h3>Income by Category</h3>
                    <canvas id="incomeChart" width="50" height="50"></canvas>
                </div>
            </div>
        </div>

        <div id="financial-info">
            <h2>Statistics</h2>
            <h3>Monthly Net Income</h3>
            <p id="net-income"></p>
            <h3>Monthly Savings Rate</h3>
            <p id="savings-rate"></p>
            <h3>Total Savings</h3>
            <p id="total-savings"></p>
            <h3>Expense Breakdown</h3>
            <ul id="expense-breakdown"></ul>
            <h3>Income Breakdown</h3>
            <ul id="income-breakdown"></ul>
        </div>

        <div id="additional-content">
            <h3>Additional Information</h3>
            <p></p>
        </div>
</main>

<!-- Add Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="./js/dashboard.js"></script>

<?php
include('includes/footer.php');
?>

