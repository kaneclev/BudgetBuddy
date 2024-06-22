<?php
$baseUrl = '/cs2450/';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav>
    <ul>
        <li>
            <a href="<?php echo $baseUrl ?>index.php" 
               class="<?php if ($current_page == 'index.php') { echo 'active'; } ?>">Dashboard</a>
        </li>
        <li>
            <a href="<?php echo $baseUrl ?>expenses.php" 
               class="<?php if ($current_page == 'expenses.php') { echo 'active'; } ?>">Expenses</a>
        </li>
        <li>
            <a href="<?php echo $baseUrl ?>income.php" 
               class="<?php if ($current_page == 'income.php') { echo 'active'; } ?>">Income</a>
        </li>
        <li>
            <a href="<?php echo $baseUrl ?>budget.php" 
               class="<?php if ($current_page == 'budget.php') { echo 'active'; } ?>">Budget</a>
        </li>
        <li>
            <a href="<?php echo $baseUrl ?>goals.php" 
               class="<?php if ($current_page == 'goals.php') { echo 'active'; } ?>">Goals</a>
        </li>
    </ul>

</nav>
