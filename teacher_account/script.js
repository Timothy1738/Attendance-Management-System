// Get all section elements
const sections = document.querySelectorAll('section');

// Get all navigation links
const links = document.querySelectorAll('#nav a');

// Add a click event listener to each navigation link
links.forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();

        // Remove the active class from all links
        links.forEach(link => {
            link.classList.remove('active');
        });

        // Add the active class to the clicked link
        this.classList.add('active');

        // Hide all sections
        sections.forEach(section => {
            section.style.display = 'none';
        });

        // Get the target section's ID from the link's href attribute
        const targetId = this.getAttribute('href').substring(1);

        // Display the target section
        document.getElementById(targetId).style.display = 'block';
    });
});