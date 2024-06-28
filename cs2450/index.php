<?php
include('includes/top.php');
?>

<main>
    <div id="dashboard" root_path="/cs2450/">
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
    </div>
</main>

<!-- Add Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="./js/dashboard.js"></script>

<?php
include('includes/footer.php');
?>

