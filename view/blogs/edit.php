<?php require_once '../view/layouts/header.php'; ?>

<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Edit Blog</h1>

        <form action="/blogs/update/<?= $blog->id ?>" method="POST" class="mb-5 p-4 bg-white shadow-md rounded">
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="<?= $blog->title ?>" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <textarea name="content" id="content" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" rows="5" required><?= $blog->content ?></textarea>
            </div>

            <div class="mb-4">
                <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                <input type="text" readonly name="author" id="author" value="<?= $blog->userName ?>" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Update Blog</button>
        </form>

        <a href="/blogs" class="text-blue-600 hover:text-blue-800">Back to Blogs</a>
    </div>
</body>

<?php require_once '../view/layouts/footer.php'; ?>