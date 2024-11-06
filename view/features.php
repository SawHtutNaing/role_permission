<?php
require_once '../view/layouts/header.php'

?>

<body class="bg-gray-100   ">
    <div class="container  mx-8 mt-10">
        <h1 class="text-3xl font-bold mb-4">Features Management</h1>

        <!-- Add Feature Form -->
        <form action="/features/store" method="POST" class="mb-5 p-4 bg-white shadow-md rounded">
            <h2 class="text-xl font-semibold mb-3">Add Feature</h2>
            <div class="mb-4">
                <label for="feature-name" class="block text-sm font-medium text-gray-700">Feature Name</label>
                <input type="text" name="name" id="feature-name" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Add Feature</button>
        </form>

        <!-- Features List -->
        <h2 class="text-xl font-semibold mb-3">Existing Features</h2>
        <ul class="bg-white shadow-md rounded p-4">
            <?php foreach ($features as $feature): ?>
                <li class="flex justify-between items-center mb-2 p-2 bg-gray-50 rounded hover:bg-gray-100">
                    <span><?= $feature->name ?></span>
                    <div>
                        <a href="/features/edit/<?= $feature->id ?>" class="text-blue-600 hover:text-blue-800">Edit</a> |
                        <a href="/features/delete/<?= $feature->id ?>" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure you want to delete this feature?');">Delete</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

<?php
require_once '../view/layouts/footer.php'

?>