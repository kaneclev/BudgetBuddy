<?php
$baseUrl = '/cs2450/';
$current_page = basename($_SERVER['PHP_SELF']);
$logged_in = false;
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
	$logged_in = true;
}
?>
<nav class="nav">
    <ul class="nav__list">
        <li class="nav__item">
            <a href="<?php echo $baseUrl . 'index.php';?>" 
               class="nav__link <?php if ($current_page == 'index.php') { echo "nav__link--active"; } ?>">Dashboard</a>
        </li>
        <li class="nav__item">
			<a href="<?php
						if ($logged_in) {	
							echo $baseUrl . 'finance/expense.php'; 
						} else { 
							echo $baseUrl . 'accounts/login.php'; 
						}
					?>"
               class="nav__link <?php if ($current_page == 'expense.php') { echo 'nav__link--active'; } ?>">Expenses</a>
        </li>
        <li class="nav__item">
            <a href="<?php 
						if ($logged_in) { 
							echo $baseUrl . 'finance/income.php'; 
						} else { 
							echo $baseUrl . 'accounts/login.php'; 
						}
					?>"
               class="nav__link <?php if ($current_page == 'income.php') { echo 'nav__link--active'; } ?>">Income</a>
        </li>
        <li class="nav__item">
            <a href="<?php 
						if ($logged_in) { 
							echo $baseUrl . 'finance/budget.php'; 
						} else { 
							echo $baseUrl . 'accounts/login.php'; 
						}
					?>"
               class="nav__link <?php if ($current_page == 'budget.php') { echo 'nav__link--active'; } ?>">Budget</a>
        </li>
		<li class="nav__item">
			<a href="<?php echo $baseUrl . 'design/about.php' ?>" class="nav__link" <?php if ($current_page == 'about.php') { echo 'nav__link--active'; }?>>About</a>
		</li>
        </ul>

</nav>
