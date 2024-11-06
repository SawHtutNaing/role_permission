<?php require_once '../view/layouts/header.php'; ?>

<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Blogs</h1>

        <a href="/blogs/create" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Create New Blog</a>

        <div class="mt-5 bg-white shadow-md rounded p-4">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Author</th>
                        <th class="px-4 py-2">Created At</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($blogs as $blog): ?>
                        <tr>
                            <td class="border px-4 py-2"><?= $blog->title ?></td>
                            <td class="border px-4 py-2"><?= $blog->author ?></td>
                            <td class="border px-4 py-2"><?= $blog->created_at ?></td>
                            <td class="border px-4 py-2">
                                <a href="/blogs/edit/<?= $blog->id ?>" class="text-blue-600 hover:text-blue-800">Edit</a>
                                <a href="/blogs/delete/<?= $blog->id ?>" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure you want to delete this blog?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

<?php require_once '../view/layouts/footer.php'; ?>