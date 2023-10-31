<?php

$usersFile = 'users.json';
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

// encode data for HTML output
function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Check if the edit form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $editedEmail = $_POST['email'];
    $users[$editedEmail]['username'] = $_POST['editedUsername'];
    $users[$editedEmail]['role'] = $_POST['editedRole'];

    // updated user data 
    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

    header("Location: admin_dashboard.php");
    exit;
}

// user's email from the URL 
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $user = $users[$email];
} else {
    header("Location: admin_dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h1 class="text-2xl font-bold mb-4">Edit User</h1>
    <div class="max-w-screen-lg mx-auto bg-white p-4 rounded shadow-lg">
        <h2 class="text-xl font-semibold mb-2">Editing User: <?php echo escape($email); ?></h2>
        <form method="post">
            <div class="mb-4">
                <label for="editedUsername" class="block text-sm font-medium text-gray-700">Username:</label>
                <input type="text" name="editedUsername" id="editedUsername" value="<?php echo escape($user['username']); ?>" class="border border-gray-300 rounded-md p-2 w-full">
            </div>
            <div class="mb-4">
                <label for="editedRole" class="block text-sm font-medium text-gray-700">Role:</label>
                <input type="text" name="editedRole" id="editedRole" value="<?php echo escape($user['role']); ?>" class="border border-gray-300 rounded-md p-2 w-full">
            </div>
            <input type="hidden" name="email" value="<?php echo escape($email); ?>">
            <button type="submit" name="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600">Save Changes</button>
        </form>
    </div>
</body>
</html>
