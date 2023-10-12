<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome To Fresh Mart Super</title>
    <script>
        function scrollToSection() {
            var element = document.getElementById("scrollToElement");
            element.scrollIntoView({ behavior: "smooth" });
        }
    </script>
    <link rel="stylesheet" type="text/css" href="../CSS/Home.css">
</head>
<body>
    <?php
    include 'includes/header.php';
    ?>

    <div class="list">
        <ul>
            <li class="first">Fresh Mart</li>
            <br>
            <br>
            <br>
            <a href="Categories/vegitables.php" target="_parent"><li>Vegitables</li></a>
            <a href="Categories/Fruits.php" target="_parent"><li>Fruits</li></a>
            <a href="Categories/baby.php" target="_parent"><li>Baby Products</li></a>
            <li>Diary</li>
            <li>Beverages</li>
            <li>Food Cupboard</li>
            <li>House Hold</li>
            <li>Cooking Essentials</li>
            <li>Bakery</li>
            <li>Frozen Food</li>
            <li>Meat</li>
            <li>Sea Food</li>
            <li>Snacks & Confectionary</li>
            <li>Rice</li>
            <li>Seeds & Spices</li>
            <li>Desserts & ingredients</li>
            <li>Tea & coffee</li>
        </ul>
    </div>

    <div class="container">
        <div class="image-box">
            <div class="image">
                <?php
                $imagePath = "../Image/Container/1.png";
                if (file_exists($imagePath)) {
                    echo '<img class="img1" src="' . $imagePath . '" alt="">';
                } else {
                    echo '<img class="img1" src="path/to/default-image.jpg" alt="Default Image">';
                }
                ?>
            </div>
            <div class="image">
                <?php
                $imagePath = "../Image/Container/2.png";
                if (file_exists($imagePath)) {
                    echo '<img class="img2" src="' . $imagePath . '" alt="">';
                } else {
                    echo '<img class="img2" src="path/to/default-image.jpg" alt="Default Image">';
                }
                ?>
            </div>
            <div class="image">
                <?php
                $imagePath = "../Image/Container/3.png";
                if (file_exists($imagePath)) {
                    echo '<img class="img3" src="' . $imagePath . '" alt="">';
                } else {
                    echo '<img class="img3" src="path/to/default-image.jpg" alt="Default Image">';
                }
                ?>
            </div>
            <div class="image">
                <?php
                $imagePath = "../Image/Container/4.png";
                if (file_exists($imagePath)) {
                    echo '<img class="img4" src="' . $imagePath . '" alt="">';
                } else {
                    echo '<img class="img4" src="path/to/default-image.jpg" alt="Default Image">';
                }
                ?>
            </div>
            <div class="image">
                <?php
                $imagePath = "../Image/Container/5.png";
                if (file_exists($imagePath)) {
                    echo '<img class="img4" src="' . $imagePath . '" alt="">';
                } else {
                    echo '<img class="img4" src="path/to/default-image.jpg" alt="Default Image">';
                }
                ?>
            </div>
            <div class="image">
                <?php
                $imagePath = "../Image/Container/6.png";
                if (file_exists($imagePath)) {
                    echo '<img class="img4" src="' . $imagePath . '" alt="">';
                } else {
                    echo '<img class="img4" src="path/to/default-image.jpg" alt="Default Image">';
                }
                ?>
            </div>
            <div class="image">
                <?php
                $imagePath = "../Image/Container/7.png";
                if (file_exists($imagePath)) {
                    echo '<img class="img4" src="' . $imagePath . '" alt="">';
                } else {
                    echo '<img class="img4" src="path/to/default-image.jpg" alt="Default Image">';
                }
                ?>
            </div>
        </div>
    </div>

    <?php
    include 'includes/footer.php'
    ?>
</body>
</html>
