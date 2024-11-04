<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#">
        <!-- PHP include for the SVG base64 logo -->
        <?php include "bennu.php" ?>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#me">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#writing">Writing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#teaching">Teaching</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#web">Web</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#translation">Translation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#form-id">Contact</a>
            </li>
        </ul>
    </div>
</nav>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var navbarToggler = document.querySelector('.navbar-toggler');
    var navbarCollapse = document.querySelector('#navbarNav');
    var heroSection = document.querySelector('#hero-section');

    // Listen for the navbar toggle button click
    navbarToggler.addEventListener('click', function() {
        // Check if the navbar is expanded
        if (navbarCollapse.classList.contains('show')) {
            heroSection.style.marginTop = '0'; // No margin when collapsed
        } else {
            heroSection.style.marginTop = '300px'; // Add margin when expanded
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var navLinks = document.querySelectorAll('.navbar-nav a');
    var navbarCollapse = document.querySelector('.navbar-collapse');

    // Offset value to scroll a bit more down after navigation
    var offset = 80; // Adjust this value as needed (e.g., height of the navbar)

    navLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            // Close the navbar after clicking the link
            navbarCollapse.classList.remove('show');

            // Scroll to the target element with an additional offset
            var targetId = link.getAttribute('href').substring(1); // Get the id without the '#'
            var targetElement = document.getElementById(targetId);

            if (targetElement) {
                e.preventDefault(); // Prevent the default anchor click behavior
                var elementPosition = targetElement
                    .offsetTop; // Get the position of the element
                var offsetPosition = elementPosition - offset; // Adjust position with offset

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth' // Smooth scroll
                });
            }
        });
    });
});
</script>
