<?php
function renderHeader($activePage) {
    $loggedIn = isset($_SESSION['user_id']);
    ?>
    <header>
        <nav>
            <ul>
                <li><a href="index.php" class="<?php echo $activePage === 'home' ? 'active' : ''; ?>">Home</a></li>
                <li><a href="adopt.php" class="<?php echo $activePage === 'adopt' ? 'active' : ''; ?>">Adopt</a></li>
                <?php if ($loggedIn): ?>
                    <li><a href="add_cat.php" class="<?php echo $activePage === 'add_cat' ? 'active' : ''; ?>">Add Cat</a></li>
                    <li><a href="process.php?action=logout">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="<?php echo $activePage === 'login' ? 'active' : ''; ?>">Login</a></li>
                    <li><a href="register.php" class="<?php echo $activePage === 'register' ? 'active' : ''; ?>">Register</a></li>
                <?php endif; ?>
                <li><a href="contact.php" class="<?php echo $activePage === 'contact' ? 'active' : ''; ?>">Contact</a></li>
            </ul>
        </nav>
    </header>
    <?php
}

function renderFooter() {
    ?>
    <footer>
        <p>&copy; 2024 CatFinder. All rights reserved.</p>
    </footer>
    <?php
}
?>
