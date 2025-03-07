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

// Language Dropdown JavaScript
document.addEventListener('DOMContentLoaded', function() {

    const dropdownToggle = document.querySelector('.dropdown-toggle');
    const dropdown = document.querySelector('.dropdown');
    const dropdownMenu = document.querySelector('.dropdown-menu');
    
    dropdownToggle.addEventListener('click', function(e) {
      e.preventDefault();
      dropdown.classList.toggle('show');
      
      const isExpanded = dropdown.classList.contains('show');
      dropdownToggle.setAttribute('aria-expanded', isExpanded);
    });
    
    document.addEventListener('click', function(e) {
      if (!dropdown.contains(e.target)) {
        dropdown.classList.remove('show');
        dropdownToggle.setAttribute('aria-expanded', 'false');
      }
    });
    
    const languageItems = document.querySelectorAll('.dropdown-item');
    languageItems.forEach(item => {
      item.addEventListener('click', function(e) {
        e.preventDefault();
        
        const lang = this.getAttribute('data-lang');
        
        const toggleText = dropdownToggle.querySelector('span:not(.icon)');
        toggleText.textContent = lang.toUpperCase();
        
        dropdown.classList.remove('show');
        dropdownToggle.setAttribute('aria-expanded', 'false');
        
        console.log('Language changed to:', lang);
      });
    });
  });

