<!DOCTYPE html>
<html>

<head>
    <title>User Registration and Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">

    <div class="w-full max-w-xs">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-center mb-4">User Login</h3>
                <form class="form" method="POST" action="process_login.php">
                    <div class="mb-4">
                        <input class="w-full border rounded-lg py-2 px-3 text-gray-700 mb-3" type="email" name="email" placeholder="Email">
                    </div>
                    <div class="mb-4">
                        <input class="w-full border rounded-lg py-2 px-3 text-gray-700 mb-3" type="password" name="password" placeholder="Password">
                    </div>
                    <div class="flex items-center justify-between">
                        <input class="bg-blue-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-pointer" type="submit" name="login" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
