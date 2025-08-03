// public/js/menu.js

document.addEventListener('DOMContentLoaded', function () {
    const items = document.querySelectorAll('.menu-container > ul > li');

    items.forEach(item => {
        item.addEventListener('click', function (e) {
            // Impede que clique em link dentro do submenu propague
            if (e.target.tagName.toLowerCase() === 'a') return;

            // Alterna a visibilidade do submenu
            const subMenu = item.querySelector('ul');
            if (subMenu) {
                item.classList.toggle('active');
            }
        });
    });
});
