
<?php
//Added registration page with form validation, password hashing, and login redirect

require 'config/config.php';
if (session_status() === PHP_SESSION_NONE){
    session_start();
}

if (isset($_SESSION['user_id'])){
    header('Location: index.php');
    exit;
}

$errors= [];
$username= '';
$email= '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $password_confirm = trim($_POST['password_confirm'] ?? '');

    if ($username === '' || $email === '' || $password === ''){
        $errors[] = 'Please fill in all fields.';
    }
    if ($username !== '' && (strlen($username) < 3 || strlen($username) > 50)){
        $errors[] = 'Username must be between 3 and 50 characters.';
    }
    if ($email !== '' && !filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors[] = 'Please enter a valid email address.';      
    }
    if ($password !== '' && strlen($password) < 8){
        $errors[] = 'Password must be at least 8 characters.';
    }
    if ($password !== $password_confirm){
        $errors[] = 'Passwords do not match. ';
    }

    if (empty($errors)){
        $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ? OR email = ?');
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()){
            $errors[] = 'Username or email is already in use.';
        }
    }

    if (empty($errors)){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES(?,?,?)');
        $stmt->execute([$username,$email,$hash]);

        header('Location: login.php?registered=1');
        exit;
    }
}

$page_title = 'Register';
require 'includes/header.php';
?>

<section class="form-card">
    <h1>Create an account</h1>

    <?php if (!empty($errors)): ?>
        <ul class="form-errors">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="register.php">
        <label for="username">Username</label>
        <input type="text" id="username" name="username"
            value="<?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8')?>" required>
        
        <label for="email">Email</label>
        <input type="email" id="email" name="email"
            value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8')?>" required>
        
        <label for="password">Password</label>
        <input type=password" id="password" name="password" required>

        <label for="password_confirm">Password</label>
        <input type="password_confirm" id="password_confirm" name="password_confirm" required>

        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login</a></p>
 </section>

 <?php require 'includes/footer.php';?>