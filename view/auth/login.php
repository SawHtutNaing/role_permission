<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-center text-gray-700">Login</h2>
            <form class="mt-6" method="post" action="/login/auth">
                <div>
                    <label class="block text-gray-700">Email</label>
                    <input type="email" name="email" class="w-full mt-2 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your email">
                </div>
                <div class="mt-4">
                    <label class="block text-gray-700">Password</label>
                    <input name="password" type="password" class="w-full mt-2 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your password">
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 mt-6 rounded-md hover:bg-blue-600">Login</button>
            </form>
            <p class="mt-4 text-center text-gray-600">Don't have an account?
                <a href="/register" class="text-blue-500 hover:underline">Register</a>
            </p>
        </div>
    </div>
</body>

</html>