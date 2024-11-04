<style>
/* General Reset */
<?php include "cardcss.php"?><?php include "aboutcss.php"?><?php include "writingcss.php"?><?php include "teachingcss.php"?>* {
    margin: 0;
    padding: 0;
}

body {
    background-color: #9b4c38;
}

/* Navbar styling */
/* Navbar styling */
.navbar {
    background-color: #9b4c38;
    width: 100%;
    height: 70px;
    position: fixed;
    top: 0;
    z-index: 10;
}


.navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=UTF8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba%28255, 255, 255, 1%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E") !important;
    /* This changes the hamburger lines to white */
}

.navbar-nav .nav-link {
    color: #F5F5F5 !important;
    /* Set the link color to white */
}

.navbar-nav {
    font-size: 20px;
    justify-content: flex-end;
}

.navbar-nav li {
    font-family: "EB Garamond", serif;
}

.navbar-nav li a {
    padding: 20px;
    color: #f8f9fa;
    /* Light color for visibility on dark background */
    text-decoration: none;
}

.navbar-nav li a:hover {
    color: #413333;
    background-color: #f4e0cb;
}


/* Ensure the navbar dropdown has its own background color and takes full width on small screens */
@media (max-width: 992px) {
    .navbar-collapse {
        background-color: #9b4c38;
        /* Same color as navbar */
        width: 100%;
        /* Ensure the dropdown takes full width */
        position: absolute;
        top: 70px;
        /* Push the dropdown below the navbar */
        left: 0;
    }

    .navbar-nav {
        flex-direction: column;
        /* Stack the menu vertically */
        width: 100%;
        /* Ensure the menu items take up full width */
    }

    .navbar-nav li {
        width: 100%;
        /* Each menu item takes full width */
    }

    .navbar-nav li a {
        text-align: center;
        /* Center text in dropdown */
        padding: 10px 0;
        /* Space between items */
    }
}

/* For screens larger than 992px */
@media (min-width: 992px) {
    #hero-section {
        margin-top: 0;
        /* No extra margin needed on large screens */
    }
}

/* Hero Section */
#hero-section {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 70vh;
    background-image: url('img/parchment.webp');
    background-size: cover;
    background-position: center;
    text-align: center;
    padding: 20px;
    padding-top: 50px;
}

.hero-content {
    display: flex;
    justify-content: center;
    /* Spreads image and text horizontally */
    align-items: center;
    width: 100%;
    /* Ensure the hero-content takes full width */
    max-width: 1200px;
    /* Optional: to limit max width */
}

.hero-image img {
    width: 300px;
    height: auto;
    border-radius: 50%;
    margin-right: 20px;
}

.hero-text {
    color: #F5F5F5;
    text-align: center;
}

.hero-text h1 {
    font-family: "EB Garamond", serif;
    font-size: 90px;
    color: #413333;
}

.hero-text p {
    font-family: "EB Garamond", serif;
    font-size: 50px;
    font-style: italic;
    font-weight: lighter;
    color: #413333;
}

/* Media query for screens smaller than 1000px */
@media only screen and (max-width: 900px) {
    #hero-section {
        height: 100vh;

    }

    .hero-content {
        flex-direction: column;
        x
        /* Stacks the image under the text */
    }

    .hero-image {
        margin-bottom: 10px;
        /* Space between image and text when stacked */
    }

    .hero-text h1 {
        font-size: 60px;
        /* Adjust heading size for smaller screens */
    }

    .hero-text p {
        font-size: 30px;
        /* Adjust paragraph size for smaller screens */
    }
}


/* Projects Section */
#projects {
    box-sizing: inherit;
    text-align: center;
    padding-top: 60px;
    color: #F5F5F5;
    background-color: #9b4c38;
}

#projects h2 {
    font-family: "EB Garamond", serif;
    font-weight: lighter;
    font-size: 40px;
}

.projects-grid {
    display: grid;
    margin: auto;
    justify-content: center;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    grid-gap: 30px;
    padding: 20px;
}

.project-tile {
    width: 100%;
    background-color: #F5F5F5;
    padding: 10px;
    border-radius: 5px;
}

.project-tile img {
    max-width: 100%;
    border-radius: 5px;
}

/* Responsive styling */
@media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
    .project-tile {
        width: 100%;
    }
}

</style>
