import './bootstrap';

import Alpine from 'alpinejs';

import feather from 'feather-icons';

window.Alpine = Alpine;

// Initialize Feather icons after the DOM is loaded
document.addEventListener('DOMContentLoaded', function () {
    feather.replace();
});

Alpine.start();
