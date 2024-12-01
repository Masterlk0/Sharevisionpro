// Toggle the sidebar visibility
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

// Handle search functionality
document.querySelector('.search-bar button').addEventListener('click', function () {
    const searchInput = document.querySelector('.search-bar input').value.trim();
    if (searchInput) {
        // Redirect to a search results page (assuming search.php exists)
        window.location.href = `search.php?q=${encodeURIComponent(searchInput)}`;
    } else {
        alert('Please enter a search term.');
    }
});

// Notifications dropdown toggle
document.querySelector('.icon[title="Notifications"]').addEventListener('click', function () {
    alert('This feature is under development.');
});

// Handle upload button action
document.querySelector('button:contains("Upload")').addEventListener('click', function () {
    window.location.href = 'upload.php';
});

// Highlight active menu item in sidebar
function highlightActiveMenu() {
    const currentUrl = window.location.href;
    const sidebarLinks = document.querySelectorAll('.sidebar a');
    sidebarLinks.forEach(link => {
        if (currentUrl.includes(link.getAttribute('href'))) {
            link.classList.add('active');
        }
    });
}
highlightActiveMenu();

// Dark mode toggle (optional feature)
document.getElementById('darkModeToggle')?.addEventListener('click', function () {
    document.body.classList.toggle('dark-mode');
    const isDarkMode = document.body.classList.contains('dark-mode');
    localStorage.setItem('darkMode', isDarkMode ? 'enabled' : 'disabled');
});

// Apply dark mode on page load if previously enabled
(function applyDarkMode() {
    const darkMode = localStorage.getItem('darkMode');
    if (darkMode === 'enabled') {
        document.body.classList.add('dark-mode');
    }
})();
