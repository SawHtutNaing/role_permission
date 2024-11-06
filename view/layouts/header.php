<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Homepage</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-blue-600 text-white p-4 flex justify-between items-center">
        <div class="text-lg font-bold">
            App Name
        </div>
        <div>
            <a href="/logout" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                Logout
            </a>
        </div>
    </header>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <nav class="w-64 bg-gray-800 text-gray-200 p-4 hidden md:block">
            <ul>
                <li class="py-2 px-4 hover:bg-gray-700 rounded">
                    <a href="/roles">Roles</a>
                </li>
                <li class="py-2 px-4 hover:bg-gray-700 rounded">
                    <a href="/permissions">Permissions</a>
                </li>
                <li class="py-2 px-4 hover:bg-gray-700 rounded">
                    <a href="/features">Features</a>
                </li>

                <li class="py-2 px-4 hover:bg-gray-700 rounded">
                    <a href="/blogs">Blog</a>
                </li>

                <li class="py-2 px-4 hover:bg-gray-700 rounded">
                    <a href="/users">Users</a>
                </li>
                <!-- <li class="py-2 px-4 hover:bg-gray-700 rounded">
                    <a href="#">Messages</a>
                </li> -->
            </ul>
        </nav>