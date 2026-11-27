<?php
$page_title = 'Home';
require __DIR__ . '/includes/header.php';
?>

<section class="hero">
    <div class="hero-content">
        <h1>GOOD FOOD, GOOD MOOD!</h1>
        <p class="hero-subtitle">Made with love, share with Crumbly.</p>

        <form class="hero-search" action="recipes.php" method="GET" role="search">
            <label for="hero-search" class="visually-hidden">Search recipes by ingredient</label>
            <input type="search" id="hero-search" name="q"
                   placeholder="Search by ingredient, e.g. potato"
                   maxlength="100" required>
            <button type="submit">Search</button>
        </form>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>