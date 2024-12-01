// Toggle sidebar visibility
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    if (sidebar.style.display === 'block') {
        sidebar.style.display = 'none';
        mainContent.classList.remove('sidebar-open');
    } else {
        sidebar.style.display = 'block';
        mainContent.classList.add('sidebar-open');
    }
}

// Highlight the active link in the sidebar
function highlightActiveSidebarLink() {
    const currentUrl = window.location.href;
    const sidebarLinks = document.querySelectorAll('.sidebar a');
    sidebarLinks.forEach(link => {
        if (currentUrl.includes(link.getAttribute('href'))) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
}

// Initialize sidebar functionality
document.addEventListener('DOMContentLoaded', () => {
    // Attach toggle functionality to the menu icon
    document.querySelector('.menu-icon').addEventListener('click', toggleSidebar);

    // Highlight the active sidebar link
    highlightActiveSidebarLink();
});
