<?php
$baseUrl = '/cs2450/';
$current_page = basename($_SERVER['PHP_SELF']);
$logged_in = false;
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
	$logged_in = true;
}
?>
<nav>
    <ul>
        <li>
            <a href="<?php echo $baseUrl . 'index.php';?>" 
               class="<?php if ($current_page == 'index.php') { echo 'active'; } ?>">Dashboard</a>
        </li>
        <li>
			<a href="<?php
						if ($logged_in) {	
							echo $baseUrl . 'expenses.php'; 
						} else { 
							echo $baseUrl . 'accounts/login.php'; 
						}
					?>"
               class="<?php if ($current_page == 'expenses.php') { echo 'active'; } ?>">Expenses</a>
        </li>
        <li>
            <a href="<?php 
						if ($logged_in) { 
							echo $baseUrl . 'income.php'; 
						} else { 
							echo $baseUrl . 'accounts/login.php'; 
						}
					?>"
               class="<?php if ($current_page == 'income.php') { echo 'active'; } ?>">Income</a>
        </li>
        <li>
            <a href="<?php 
						if ($logged_in) { 
							echo $baseUrl . 'budget.php'; 
						} else { 
							echo $baseUrl . 'accounts/login.php'; 
						}
					?>"
               class="<?php if ($current_page == 'budget.php') { echo 'active'; } ?>">Budget</a>
        </li>
        <li>
            <a href="<?php 
						if ($logged_in) { 
							echo $baseUrl . 'goals.php'; 
						} else { 
							echo $baseUrl . 'accounts/login.php';		
						}
					?>"
               class="<?php if ($current_page == 'goals.php') { echo 'active'; } ?>">Goals</a>
        </li>
		<?php
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
			echo '<li> <a href="accounts/logout-handler.php" id="logoutButton">Logout</a></li>';
		}
		?>
    </ul>

</nav>
