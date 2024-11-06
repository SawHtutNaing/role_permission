<?php require_once '../view/layouts/header.php'; ?>

<div class="max-w-2xl mx-auto bg-white p-8 mt-10 rounded shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit User</h2>

    <form action="/users/update/<?= $user['id']?>" method="POST" class="space-y-6">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">

        <!-- Name Field -->
        <div>
            <label for="name" class="block text-gray-700 font-semibold">Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>"
                class="w-full mt-2 p-3 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                required>
        </div>

        <!-- Email Field -->
        <div>
            <label for="email" class="block text-gray-700 font-semibold">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"
                class="w-full mt-2 p-3 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                required>
        </div>

        <!-- Role Dropdown -->
        <div>
            <label for="role_id" class="block text-gray-700 font-semibold">Role:</label>
            <select id="role_id" name="role_id"
                class="w-full mt-2 p-3 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                required>
                <?php foreach ($roles as $role): ?>
                <option value="<?= $role->id ?>" <?= $user['role_id'] == $role->id ? 'selected' : '' ?>>
                    <?= htmlspecialchars($role->name) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit"
                class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                Update User
            </button>
        </div>
    </form>
</div>

<?php require_once '../view/layouts/footer.php'; ?>