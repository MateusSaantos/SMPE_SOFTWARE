document.addEventListener('DOMContentLoaded', function () {
    const submenuItems = document.querySelectorAll('.has-submenu');
    const menuToggle = document.getElementById('menu-toggle');
    const sidebarMenu = document.getElementById('sidebarMenu');

    // Toggle submenu (abre e fecha)
    submenuItems.forEach(item => {
        item.addEventListener('click', function () {
            this.classList.toggle('active');
        });
    });

    // Toggle menu (mobile)
    if (menuToggle && sidebarMenu) {
        menuToggle.addEventListener('click', () => {
            sidebarMenu.classList.toggle('show');
        });
    }
});
