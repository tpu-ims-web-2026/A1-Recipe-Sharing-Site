<?php
// includes/navbar.php
// Navigation bar. The links change according to the login status.
// Session keys used here: user_id and role.

$is_logged_in = isset($_SESSION['user_id']);
$is_admin = $is_logged_in && ($_SESSION['role'] ?? '') === 'admin';
?>
<header class="site-header">
    <nav class="navbar" aria-label="Main navigation">
        <a href="index.php" class="logo">crumbly</a>

        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="recipes.php">Recipes</a></li>
            <li><a href="index.php#categories">Categories</a></li>
            <li><a href="submit_recipe.php">Share a Recipe</a></li>

            <?php if ($is_logged_in): ?>
                <li><a href="profile.php">My Profile</a></li>
                <?php if ($is_admin): ?>
                    <li><a href="admin.php">Admin</a></li>
                <?php endif; ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>