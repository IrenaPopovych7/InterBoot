document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const menuClose = document.querySelector('.menu-close');
    const mobileMenu = document.getElementById('mobileMenu');

    if (menuToggle && menuClose && mobileMenu) {
        menuToggle.addEventListener('click', function() {
            mobileMenu.classList.add('active');
        });

        menuClose.addEventListener('click', function() {
            mobileMenu.classList.remove('active');
        });
    }
});