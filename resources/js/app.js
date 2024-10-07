import './bootstrap';

window.toggleDarkMode = function () {
    const body = document.body;
    body.classList.toggle('dark');

    // Save the user's preference in localStorage
    if (body.classList.contains('dark')) {
        localStorage.setItem('darkMode', 'enabled');
    } else {
        localStorage.setItem('darkMode', 'disabled');
    }
}

// Check for saved user preferences, if any, and apply them
document.addEventListener('DOMContentLoaded', (event) => {
    if (localStorage.getItem('darkMode') === 'enabled') {
        document.body.classList.add('dark');
    }
});
