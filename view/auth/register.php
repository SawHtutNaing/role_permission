<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-center text-gray-700">Create an Account</h2>
            <form class="mt-6" action="/register/store" method="post">
                <div class="mb-4">
                    <label class="block text-gray-700"> Name</label>
                    <input type="text" name="name" class="w-full mt-2 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="John Doe">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Email Address</label>
                    <input type="email" name="email" class="w-full mt-2 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="john@example.com">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Password</label>
                    <input type="password" name="password" class="w-full mt-2 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="********">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Confirm Password</label>
                    <input type="password" name="pass_confirmation" class="w-full mt-2 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="********">
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 mt-6 rounded-md hover:bg-blue-600">Register</button>
            </form>
            <p class="mt-6 text-center text-gray-600">Already have an account?
                <a href="#" class="text-blue-500 hover:underline">Login</a>
            </p>
        </div>
    </div>
</body>

</html>