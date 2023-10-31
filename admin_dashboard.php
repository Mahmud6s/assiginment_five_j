<?php
// Read users from users.json file
$usersFile = 'users.json';
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

// encode data for HTML output
function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// delete 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $emailToDelete = $_POST['emailToDelete'];

    // Remove user with email
    unset($users[$emailToDelete]);

    // updated user data
    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="max-w-screen-lg mx-auto bg-white p-4 rounded shadow-lg">
    <h1 class="text-3xl font-semibold mb-4" style="color: #3366ff; font-family: 'Arial', sans-serif; text-shadow: 2px 2px 4px #888888;">Welcome, Admin!</h1>
<a href="logout.php?logout=true" style="text-decoration: none; padding: 8px 12px; border-radius: 4px; background-color: #ff3333; color: white; font-weight: bold;">Logout</a>

       

<h2 class="text-2xl mt-8 mb-4" style="color: #4a5568; font-family: 'Arial', sans-serif;">User List</h2>
<table class="w-full border-collapse border border-gray-300" style="font-family: 'Arial', sans-serif;">
    <tr class="bg-gray-200">
        <th class="p-2" style="background-color: #CBD5E0; text-align: center;">Username</th>
        <th class="p-2" style="background-color: #CBD5E0; text-align: center;">Email</th>
        <th class="p-2" style="background-color: #CBD5E0; text-align: center;">Role</th>
        <th class="p-2" style="background-color: #CBD5E0; text-align: center;">Actions</th>
    </tr>
    <?php foreach ($users as $email => $userData) {
        $username = escape($userData['username']);
        $role = escape($userData['role']);
        echo "<tr>
                  <td class='p-2 text-center' style='border: 1px solid #d2d6dc;'>$username</td>
                  <td class='p-2 text-center' style='border: 1px solid #d2d6dc;'>$email</td>
                  <td class='p-2 text-center' style='border: 1px solid #d2d6dc;'>$role</td>
                  <td class='p-2 text-center' style='border: 1px solid #d2d6dc;'>
                      <a href='edit_admin.php?email=$email' class='text-blue-500' style='text-decoration: none; margin-right: 8px;'>Edit</a>
                      <form method='post' style='display: inline;'>
                           <input type='hidden' name='emailToDelete' value='$email'>
                           <button type='submit' name='delete' class='text-red-500' style='background-color: transparent; border: none; cursor: pointer;' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</button>
                      </form>
                  </td>
              </tr>";
    } ?>
</table>

    </div>
</body>
</html>
