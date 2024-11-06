<?php require_once '../view/layouts/header.php'; ?>

<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Edit Permission</h1>

        <!-- Edit Permission Form -->
        <form action="/permissions/update/<?= $permission->id ?>" method="POST" class="mb-5 p-4 bg-white shadow-md rounded">
            <h2 class="text-xl font-semibold mb-3">Edit Permission</h2>
            <div class="mb-4">
                <label for="permission-name" class="block text-sm font-medium text-gray-700">Permission Name</label>
                <input type="text" name="name" id="permission-name" value="<?= $permission->name ?>" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Save Changes</button>
        </form>

        <a href="/permissions" class="text-blue-600 hover:text-blue-800">Back to Permissions List</a>
    </div>
</body>

<?php require_once '../view/layouts/footer.php'; ?>