<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/staff/books/addBook.css">
    <title>Create New Book</title>
</head>

<body>
    <div class="main-content">
        <div class="sidebar">
            <?php include_once VIEW_PATH . '/layouts/parts/staff/sidebar.staff.php' ?>
        </div>

        <div class="container">
            <div class="container-header">
                <h2>ADD NEW BOOK</h2>
            </div>

            <div class="container-content">
                <form action="/<?= PROJECT_NAME ?>/staff/books" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Book name:</label>
                        <input type="text" id="name" name="name" placeholder="Book name">
                    </div>

                    <div class="form-group">
                        <label for="author">Author:</label>
                        <input type="text" id="author" name="author" placeholder="Author">

                    </div>

                    <div class="form-group">
                        <label for="publisher">Publisher:</label>
                        <input type="text" id="publisher" name="publisher" placeholder="Publisher">
                    </div>

                    <div class="form-group">
                        <label for="pages">Pages:</label>
                        <input type="text" id="pages" name="pages" placeholder="Pages">

                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" id="price" name="price" placeholder="Price">
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="text" id="quantity" name="quantity" placeholder="Quantity">

                    </div>


                    <div class="form-group">
                        <label for="cover">Cover:</label>
                        <input type="file" id="cover" name="cover" placeholder="cover">
                    </div>

                    <div class="form-group">
                        <a href="index.books.php" class="cancel-btn">Cancel</a>
                        <input type="submit" name="submit" class="submit-btn" value="Create Book">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>