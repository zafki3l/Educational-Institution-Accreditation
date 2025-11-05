<div class="header">
    <ul type="none" class="user-menu">
        <!-- Search bar -->
        <li class="search-bar">
            <form action="" method="get">
                <input type="text" name="book" placeholder="Search books..." />
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </li>

        <!-- Cart icon -->
        <li class="cart-icon">
            <a href="/oop-bookstore/views/carts/mycart.carts.php?user=<?= $_SESSION['id'] ?? '' ?>"><i class="fas fa-shopping-cart"></i></a>
        </li>
    </ul>
</div>