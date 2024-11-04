<?php
// Start buffering output
ob_start();

// Include the chat functionality, making sure no output occurs before session_start()
?>

<?php
// Start session to store messages
session_start();


// Disable error reporting temporarily
error_reporting(0);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dugald Steer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
        integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=EB+Garamond|Montserrat:400,800&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <?php include "includes/style.php";
    include "includes/dugbot_styles.php"?>
</head>

<body>
    <!-- Navigation -->
    <?php include "includes/nav.php"?>

    <!-- Hero Section -->

    <?php include "includes/hero.php" ?>
    <?php include "includes/dugbot.php" ?>
    <?php include "includes/cards.php" ?>
    <?php include "includes/writing.php"?>
    <?php include "includes/teaching.php"?>
    <?php include "includes/web.php"?>
    <?php include "includes/translation.php"?>
    <?php include "includes/about.php"?>
    <?php include "includes/footer.php" ?>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
