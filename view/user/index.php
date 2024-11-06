<?php require_once '../view/layouts/header.php'; ?>



<body class="bg-gray-100">

    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">User List</h1>

        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    <th class="py-3 px-6 text-left">Username</th>
                    <th class="py-3 px-6 text-left">Role</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm font-light">



                <?php foreach ($users as $user): ?>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left">
                        <?= htmlspecialchars($user->name) ?>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <?= htmlspecialchars($user->role_name) ?>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <a href="/users/edit/<?= $user->id ?>" class="text-blue-600 hover:text-blue-800">Edit</a> |
                        <a href="/users/delete/<?= $user->id ?>" class="text-red-600 hover:text-red-800"
                            onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

</body>


<?php require_once '../view/layouts/footer.php'; ?>