<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/staff/books/index.books.css">
    <title>Book Management</title>
</head>

<body>
    <div class="main-content">
        <!--Sidebar-->
        <div class="sidebar">
            <?php include_once VIEW_PATH . '/layouts/parts/staff/sidebar.staff.php' ?>
        </div>

        <div class="content">
            <div class="book-header">
                <div class="header-text">
                    <h2>Book Management</h2>
                    <h3>WELCOME <?php echo htmlspecialchars($_SESSION['user']['last_name']) ?></h3>
                </div>

                <!-- Thanh tìm kiếm -->
                <div class="search-add">
                    <a href="/<?= PROJECT_NAME ?>/staff/books/create" class="addBook">Add book</a>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>BOOK ID</th>
                            <th>BOOK NAME</th>
                            <th>AUTHOR</th>
                            <th>PUBLISHER</th>
                            <th>PAGES</th>
                            <th>CATEGORY</th>
                            <th>DESCRIPTION</th>
                            <th>PRICE</th>
                            <th>QUANTITY</th>
                            <th>STATUS</th>
                            <th>COVER</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <td><?= htmlspecialchars($book['id']) ?></td>
                                <td><?= htmlspecialchars($book['name']) ?></td>
                                <td><?= htmlspecialchars($book['author']) ?></td>
                                <td><?= htmlspecialchars($book['publisher']) ?></td>
                                <td><?= htmlspecialchars($book['pages']) ?></td>
                                <td><?= NULL ?></td>
                                <td><?= htmlspecialchars($book['description']) ?></td>
                                <td><?= number_format(htmlspecialchars($book['price']), 0, ',', '.') ?>VNĐ</td>
                                <td><?= htmlspecialchars($book['quantity']) ?></td>
                                <td><?= htmlspecialchars($book['status'] == 1 ? 'In stock' : 'Out stock') ?></td>
                                <td><img src="/<?= PROJECT_NAME ?>/public/images/books/<?= htmlspecialchars($book['cover']) ?>" alt="<?= htmlspecialchars($book['cover']) ?>"></td>
                                <td>
                                    <a href="" class="edit-btn"><i class="fa-solid fa-pen"></i></a>
                                    <button class="delete-btn">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>

</html>