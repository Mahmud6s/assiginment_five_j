<?php
session_start();

$usersFile = 'users.json';

$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

function saveUsers($users, $file)
{
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
}

// Login Form Handling
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (isset($users[$email]) && $users[$email]['password'] === $password) {
        $_SESSION['email'] = $email;

        if ($users[$email]['role'] === 'admin') {
            header('Location: admin_dashboard.php');
            exit();
        } else {
            header('Location: user_dashboard.php'); 
            exit();
        }
    } else {
        $errorMsg = "Invalid email or password.";
    }
}
?>
