// Function to show the selected section and hide others
function showSection(section) {
    // Get all sections
    const sections = document.querySelectorAll('.admin-section');
    
    // Hide all sections first
    sections.forEach(function(sec) {
        sec.style.display = 'none';
    });

    // Show the selected section
    const selectedSection = document.getElementById(section);
    selectedSection.style.display = 'block';
}
