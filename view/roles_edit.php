<?php require_once '../view/layouts/header.php'; ?>

<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Edit Role</h1>

        <!-- Edit Role Form -->
        <form action="/roles/update/<?= $role->id ?>" method="POST" class="mb-5 p-4 bg-white shadow-md rounded">
            <h2 class="text-xl font-semibold mb-3">Edit Role</h2>
            <div class="mb-4">
                <label for="role-name" class="block text-sm font-medium text-gray-700">Role Name</label>
                <input type="text" name="name" id="role-name" value="<?= $role->name ?>" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <!-- Permissions -->
            <h2 class="text-xl font-semibold mb-3">Assign Permissions</h2>
            <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($permissions as $permission): ?>
                    <label class="block">
                        <input type="checkbox" name="permissions[]" value="<?= $permission->id ?>" <?= in_array($permission->id, $rolePermissions) ? 'checked' : '' ?>>
                        <?= $permission->name ?>
                    </label>
                <?php endforeach; ?>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Save Changes</button>
        </form>

        <a href="/roles" class="text-blue-600 hover:text-blue-800">Back to Roles List</a>
    </div>
</body>

<?php require_once '../view/layouts/footer.php'; ?>